<?php
/**
 * Created by IntelliJ IDEA.
 * User: George Dawoud
 * Date: 1/17/2016
 * Time: 8:01 AM
 */
// Include the function library
require 'Include/Config.php';
require 'Include/Functions.php';
require 'Include/PersonFunctions.php';

require_once "service/DashboardService.php";

// Set the page title
$sPageTitle = "Members Dashboard";

require 'Include/Header.php';

$dashboardService = new DashboardService();
$personStats = $dashboardService->getPersonStats();
$familyCount = $dashboardService->getFamilyCount();
$sundaySchoolStats = $dashboardService->getSundaySchoolStats();
$demographicStats = $dashboardService->getDemographic();
?>

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Cart Functions</h3>
    </div>
    <div class="box-body">
        <a href="SelectList.php?mode=person" class="btn btn-app"><i class="fa fa-user"></i><?= gettext("All People") ?></a>
        <a href="OptionManager.php?mode=classes" class="btn btn-app"><i class="fa fa-gears"></i><?= gettext("Classifications Manager") ?></a>
        <br/>
        <a href="FamilyList.php" class="btn btn-app"><i class="fa fa-users"></i><?= gettext("All Families") ?></a>
        <a href="OptionManager.php?mode=famroles" class="btn btn-app"><i class="fa fa-cubes"></i><?= gettext("Family Roles") ?></a>
        <a href="GeoPage.php" class="btn btn-app"><i class="fa fa-globe"></i><?= gettext("Family Geographic") ?></a>
        <a href="MapUsingGoogle.php?GroupID=-1" class="btn btn-app"><i class="fa fa-map"></i><?= gettext("Family Map") ?></a>
        <a href="UpdateAllLatLon.php" class="btn btn-app"><i class="fa fa-map-pin"></i><?= gettext("Update All Family Coordinates") ?></a>
        <? if ($_SESSION['bAdmin']) {?>
        <br/>
        <a href="VolunteerOpportunityEditor.php" class="btn btn-app"><i class="fa fa-bullhorn"></i><?= gettext("Volunteer Opportunities") ?></a>
        <a href="PersonCustomFieldsEditor.php" class="btn btn-app"><i class="fa fa-gear"></i><?= gettext("Custom Person Fields") ?></a>
        <a href="FamilyCustomFieldsEditor.php" class="btn btn-app"><i class="fa fa-gear"></i><?= gettext("Custom Family Fields") ?></a>
        <? } ?>

    </div>
</div>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?= $familyCount['familyCount'] ?>
                </h3>
                <p>
                    Families
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="<?php echo $sURLPath."/"; ?>FamilyList.php" class="small-box-footer">
                See all Families <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?= $personStats['personCount']?>
                </h3>
                <p>
                    Members
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo $sURLPath."/"; ?>SelectList.php?mode=person" class="small-box-footer">
                See All Member <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?= $sundaySchoolStats['kids'] ?>
                </h3>
                <p>
                    Sunday School Kids
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-happy"></i>
            </div>
            <a href="<?php echo $sURLPath."/"; ?>Reports\SundaySchoolClassList.php" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-6 col-xs-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pie-chart"></i>

                <h3 class="box-title">Family Roles</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tr>
                        <th>Role / Gender</th>
                        <th>% of Members</th>
                        <th style="width: 40px">Count</th>
                    </tr>
                    <? foreach ($demographicStats as $key => $value) { ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-success" style="width: <?= round($value/$personCount['personCount']*100) ?>%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-green"><?= $value ?></span></td>
                    </tr>
                    <? } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>

                <h3 class="box-title">People Classification</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <table class="table table-condensed">
                <tr>
                    <th>Classification</th>
                    <th>% of Members</th>
                    <th style="width: 40px">Count</th>
                </tr>
                <? foreach ($personStats as $key => $value) { ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-success" style="width: <?= round($value/$personCount['personCount']*100) ?>%"></div>
                            </div>
                        </td>
                        <td><span class="badge bg-green"><?= $value ?></span></td>
                    </tr>
                <? } ?>
            </table>
            <!-- /.box-body-->
        </div>
        <div class="box box-info">
            <div class="box-header">
                <i class="ion ion-android-contacts"></i>
                <h3 class="box-title">Gender Demographics</h3>
                <div class="box-tools pull-right">
                    <div id="gender-donut-legend" class="chart-legend"></div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <canvas id="gender-donut" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>
<? require 'Include/Footer.php'; ?>