<?php

namespace Automile\Sdk\Tests\Functional\Endpoints;

use Automile\Sdk\Models\Vehicle\Defect;
use Automile\Sdk\Models\Vehicle\DefectAttachment;
use Automile\Sdk\Models\Vehicle\DefectAttachmentRowset;
use Automile\Sdk\Models\Vehicle\DefectComment;
use Automile\Sdk\Models\Vehicle\DefectCommentRowset;
use Automile\Sdk\Models\Vehicle\DefectRowset;
use Automile\Sdk\Models\Vehicle\DefectStatus;
use Automile\Sdk\Models\Vehicle\DefectStatusRowset;
use Automile\Sdk\Models\Vehicle\Inspection;
use Automile\Sdk\Models\Vehicle\InspectionExport;
use Automile\Sdk\Models\Vehicle\InspectionRowset;
use Automile\Sdk\Models\Vehicle\InspectionStatus;
use Automile\Sdk\Models\Vehicle\InspectionStatusRowset;
use Automile\Sdk\Tests\Functional\TestAbstract;
use Automile\Sdk\Types\AttachmentType;
use Automile\Sdk\Types\VehicleDefectStatusType;
use Automile\Sdk\Types\VehicleDefectType;

/**
 * VehicleInspection API Calls
 */
class VehicleInspectionTest extends TestAbstract
{

    public function testGetById()
    {
        $inspection = self::_getClient()->getByInspectionId(self::_getSettings('vehicle_inspection.id'));

        $this->assertInstanceOf(Inspection::class, $inspection);
        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionDateUtc());

        $this->assertInstanceOf(DefectRowset::class, $inspection->getVehicleDefects());
        $this->assertGreaterThan(0, count($inspection->getVehicleDefects()));
        $this->assertInstanceOf(Defect::class, $inspection->getVehicleDefects()[0]);
        $this->assertInstanceOf(\DateTime::class, $inspection->getVehicleDefects()[0]->getDefectDateUtc());

        $this->assertInstanceOf(InspectionStatusRowset::class, $inspection->getInspectionStatus());
        $this->assertGreaterThan(0, count($inspection->getInspectionStatus()));
        $this->assertInstanceOf(InspectionStatus::class, $inspection->getInspectionStatus()[0]);
        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionStatus()[0]->getStatusDateUtc());
    }

    public function testGetByInspectionIdVehicleAndDate()
    {
        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(self::_getSettings('vehicle_inspection.id'));
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertEquals(1, count($inspections));
        $this->assertInstanceOf(Inspection::class, $inspections[0]);

        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(null, self::_getSettings('vehicle_inspection.vehicle_id'));
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertGreaterThan(0, count($inspections));
        $this->assertInstanceOf(Inspection::class, $inspections[0]);

        $startDate = new \DateTime('2017-01-01');
        $endDate = new \DateTime('2017-02-01');
        $inspections = self::_getClient()->getByInspectionIdVehicleAndDate(null, null, $startDate, $endDate);
        $this->assertInstanceOf(InspectionRowset::class, $inspections);
        $this->assertGreaterThan(0, count($inspections));
        foreach ($inspections as $inspection) {
            $this->assertInstanceOf(Inspection::class, $inspection);
            $this->assertGreaterThanOrEqual($startDate, $inspection->getInspectionDateUtc());
            $this->assertLessThanOrEqual($endDate, $inspection->getInspectionDateUtc());
        }
    }

    /**
     * @return Inspection $inspection
     */
    public function testCreateInspection()
    {
        $data = [
            "VehicleId" => self::_getSettings('vehicle_inspection.vehicle_id'),
            "InspectionDateUtc" => "2017-03-15",
            "VehicleDefects" => [
                [
                    "DefectType" => VehicleDefectType::OTHER,
                    "Notes" => "note1",
                    "VehicleDefectStatus" => [
                        [ "DefectStatus" => VehicleDefectStatusType::NOT_RESOLVED ]
                    ],
                    "VehicleDefectAttachments" => [
                        [
                            "AttachmentType" => AttachmentType::IMAGE,
                            "DataFile" => "https://www.google.com/images/logo.png"
                        ]
                    ],
                    "VehicleDefectComments" => [
                        [ "Comment" => "Comment 1" ],
                        [ "Comment" => "Comment 2" ]
                    ]
                ]
            ]
        ];
        $inspectionCreate = new Inspection($data);

        $inspection = self::_getClient()->createInspection($inspectionCreate);

        $this->assertInstanceOf(\DateTime::class, $inspection->getInspectionDateUtc());
        $this->assertEquals($data['InspectionDateUtc'], $inspection->getInspectionDateUtc()->format('Y-m-d'));

        $this->assertInstanceOf(DefectRowset::class, $inspection->getVehicleDefects());
        $this->assertCount(1, $inspection->getVehicleDefects());
        $this->assertInstanceOf(Defect::class, $inspection->getVehicleDefects()[0]);

        $defect = $inspection->getVehicleDefects()[0];

        $this->assertInstanceOf(DefectStatusRowset::class, $defect->getVehicleDefectStatus());
        $this->assertCount(1, $defect->getVehicleDefectStatus());
        $this->assertInstanceOf(DefectStatus::class, $defect->getVehicleDefectStatus()[0]);

        $this->assertInstanceOf(DefectAttachmentRowset::class, $defect->getVehicleDefectAttachments());
        $this->assertCount(1, $defect->getVehicleDefectAttachments());
        $this->assertInstanceOf(DefectAttachment::class, $defect->getVehicleDefectAttachments()[0]);

        $attachment = $defect->getVehicleDefectAttachments()[0];
        $originalFile = getimagesize($data['VehicleDefects'][0]['VehicleDefectAttachments'][0]['DataFile']);
        $this->assertNotEmpty($originalFile);
        $remoteFile = getimagesize('http://content.automile.com/images/' . $attachment->getAttachmentLocation());
        $this->assertNotEmpty($remoteFile);
        $this->assertEquals($originalFile[3], $remoteFile[3]);

        $this->assertInstanceOf(DefectCommentRowset::class, $defect->getVehicleDefectComments());
        $this->assertCount(2, $defect->getVehicleDefectComments());
        $this->assertInstanceOf(DefectComment::class, $defect->getVehicleDefectComments()[0]);

        return $inspection;
    }

    /**
     * @depends testCreateInspection
     * @param Inspection $inspectionCreated
     */
    public function testEditInspection(Inspection $inspectionCreated)
    {
        $defectCreated = $inspectionCreated->getVehicleDefects()[0];
        $commentCreated = $defectCreated->getVehicleDefectComments()[0];
        $attachmentCreated = $defectCreated->getVehicleDefectAttachments()[0];

        $data = [
            "VehicleInspectionId" => $inspectionCreated->getVehicleInspectionId(),
            "VehicleDefects" => [
                [
                    "VehicleDefectId" => $defectCreated->getVehicleDefectId(),
                    "DefectType" => VehicleDefectType::BATTERY,
                    "DefectStatusType" => VehicleDefectStatusType::RESOLVED,
                    "Notes" => "note1 - edited",
                    /*"VehicleDefectAttachments" => [
                        [
                            "VehicleDefectAttachmentId" => $attachmentCreated->getVehicleDefectAttachmentId(),
                            "AttachmentType" => AttachmentType::IMAGE,
                            "DataFile" => "http://help.bing.microsoft.com/Resources/content/styles/Images/logo_bing.png"
                        ]
                    ],*/
                    "VehicleDefectComments" => [
                        [
                            "VehicleDefectCommentId" => $commentCreated->getVehicleDefectCommentId(),
                            "Comment" => "Comment 1 - edited"
                        ]
                    ]
                ]
            ]
        ];
        $inspectionEdit = new Inspection($data);

        $inspectionEdited = self::_getClient()->editInspection($inspectionEdit);
        $this->assertInstanceOf(Inspection::class, $inspectionEdited);

        $inspection = self::_getClient()->getByInspectionId($inspectionEdited->getVehicleInspectionId());

        $this->assertInstanceOf(DefectRowset::class, $inspection->getVehicleDefects());
        $this->assertCount(1, $inspection->getVehicleDefects());
        $this->assertInstanceOf(Defect::class, $inspection->getVehicleDefects()[0]);

        $defect = $inspection->getVehicleDefects()[0];

        $this->assertEquals($data['VehicleDefects'][0]['Notes'], $defect->getNotes());
        $this->assertEquals($data['VehicleDefects'][0]['DefectStatusType'], $defect->getDefectStatusType());
        $this->assertEquals($data['VehicleDefects'][0]['DefectType'], $defect->getDefectType());

        $this->assertInstanceOf(DefectAttachmentRowset::class, $defect->getVehicleDefectAttachments());
        $this->assertCount(1, $defect->getVehicleDefectAttachments());
        $this->assertInstanceOf(DefectAttachment::class, $defect->getVehicleDefectAttachments()[0]);

        /*$attachment = $defect->getVehicleDefectAttachments()[0];
        $originalFile = getimagesize($data['VehicleDefects'][0]['VehicleDefectAttachments'][0]['DataFile']);
        $this->assertNotEmpty($originalFile);
        $remoteFile = getimagesize('http://content.automile.com/images/' . $attachment->getAttachmentLocation());
        $this->assertNotEmpty($remoteFile);
        $this->assertEquals($originalFile[3], $remoteFile[3]);*/

        $this->assertInstanceOf(DefectCommentRowset::class, $defect->getVehicleDefectComments());
        $this->assertCount(2, $defect->getVehicleDefectComments());
        $this->assertInstanceOf(DefectComment::class, $defect->getVehicleDefectComments()[0]);
        $this->assertEquals($data['VehicleDefects'][0]['VehicleDefectComments'][0]['Comment'], $defect->getVehicleDefectComments()[0]->getComment());
    }

    public function testExportVehicleInspection()
    {
        $data = [
            'ToEmail' => self::_getSettings('vehicle_inspection.export_email'),
            'ISO639LanguageCode' => 'en'
        ];
        $result = self::_getClient()->exportVehicleInspection(self::_getSettings('vehicle_inspection.id'), new InspectionExport($data));
        $this->assertTrue($result);
    }

}
