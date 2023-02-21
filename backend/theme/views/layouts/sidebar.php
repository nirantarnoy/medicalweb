<aside class="main-sidebar sidebar-dark-blue elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?r=site/index" class="brand-link">
<!--        <img src="--><?php //echo Yii::$app->request->baseUrl; ?><!--/uploads/logo/narono_logo.png" alt="Narono" class="brand-image">-->
<!--        <span class="brand-text font-weight-light">VORAPAT</span>-->
        <span class="brand-text font-weight-light">Medical Web</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?r=site/index" class="nav-link site">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            ภาพรวมระบบ
                            <!--                                <i class="right fas fa-angle-left"></i>-->
                        </p>
                    </a>
                </li>

                <?php if (\Yii::$app->user->can('mainconfig/index')): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                ตั้งค่าทั่วไป
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?r=mainconfig" class="nav-link mainconfig">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>Import Master</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=sequence" class="nav-link sequence">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>เลขที่เอกสาร</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            ข้อมูลเวชภัณฑ์
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('warehouse/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=medicalcat/index" class="nav-link medicalcat">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>หมวดหมู่</p>
                                </a>
                            </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('location/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=medical" class="nav-link medical">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>
                                    เวชภัณฑ์
                                    <!--                                <span class="right badge badge-danger">New</span>-->
                                </p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('location/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=unit" class="nav-link unit">
                                <i class="far fa-oil-can nav-icon"></i>
                                <p>
                                    หน่วยนับ
                                    <!--                                <span class="right badge badge-danger">New</span>-->
                                </p>
                            </a>
                        </li>
                        <?php //endif; ?>


                    </ul>
                </li>

                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            คลัง/จำนวนคงเหลือ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('location/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=warehouse" class="nav-link warehouse">
                                <i class="far fa-oil-can nav-icon"></i>
                                <p>
                                    คลังที่จัดเก็บ
                                    <!--                                <span class="right badge badge-danger">New</span>-->
                                </p>
                            </a>
                        </li>
                        <?php //endif; ?>


                        <?php //if (\Yii::$app->user->can('customertype/index')): ?>
<!--                            <li class="nav-item">-->
<!--                                <a href="index.php?r=customertype/index" class="nav-link customertype">-->
<!--                                    <i class="far fa-circlez nav-icon"></i>-->
<!--                                    <p>ประเภทลูกค้า</p>-->
<!--                                </a>-->
<!--                            </li>-->
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('customers/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=stocksum" class="nav-link stocksum">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>
                                        สินค้าคงคลัง
                                        <!--                                <span class="right badge badge-danger">New</span>-->
                                    </p>
                                </a>
                            </li>
                        <?php //endif; ?>

                    </ul>
                </li>

                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            ทำรายการรับ/จ่าย
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('salecomreport/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=itemrecieve" class="nav-link itemrecieve">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>รับเวชภัณฑ์</p>
                                </a>
                            </li>
                        <?php //endif;?>
                        <?php //if (\Yii::$app->user->can('salecomreport/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=itemissue" class="nav-link itemissue">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>จ่ายเวชภัณฑ์</p>
                                </a>
                            </li>
                        <?php //endif;?>

                    </ul>
                </li>
                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            รายงาน
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('salecomreport/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=reports/lowstock" class="nav-link lowstock">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>สินค้าต่ำกว่า stock</p>
                                </a>
                            </li>
                        <?php //endif;?>
                        <?php if (\Yii::$app->user->can('salecomreport/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=salecomreport" class="nav-link salecomreport">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>รายงานจ่าย</p>
                                </a>
                            </li>
                        <?php endif;?>

                    </ul>
                </li>
                <?php // if (isset($_SESSION['user_group_id'])): ?>
                <?php //if ($_SESSION['user_group_id'] == 1): ?>
                <?php //if (\Yii::$app->user->identity->username == 'iceadmin'): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                ผู้ใช้งาน
                                <i class="fas fa-angle-left right"></i>
                                <!--                                <span class="badge badge-info right">6</span>-->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php //if (\Yii::$app->user->can('usergroup/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=usergroup" class="nav-link usergroup">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>กลุ่มผู้ใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif; ?>
                            <?php //if (\Yii::$app->user->can('user/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=user" class="nav-link user">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>ผู้ใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif;?>

                            <?php //if (\Yii::$app->user->can('authitem/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=authitem" class="nav-link auth">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>สิทธิ์การใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif;?>

                        </ul>
                    </li>
                <?php //if (\Yii::$app->user->can('dbbackup/backuplist')): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                สำรองข้อมูล
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?r=dbbackup/backuplist" class="nav-link dbbackup">
                                    <i class="far fa-file-archive nav-icon"></i>
                                    <p>สำรองข้อมูล</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=dbrestore/restorepage" class="nav-link dbrestore">
                                    <i class="fa fa-upload nav-icon"></i>
                                    <p>กู้คืนข้อมูล</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php //endif;?>
                <?php //endif; ?>
                <?php //endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

