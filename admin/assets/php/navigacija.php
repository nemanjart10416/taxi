<meta name="viewport" content="width=1524">
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <svg class="fill1 p-1" height="30" width="30" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 1792 1792" xml:space="preserve">
                <path d="M1673.9,1363.2L1673.9,1363.2c0,52.3-42.4,94.3-94.3,94.3H212.7c-52.3,0-94.3-42.4-94.3-94.3l0,0
                    c0-52.3,42.4-94.3,94.3-94.3h1366.8C1631.5,1268.5,1673.9,1310.9,1673.9,1363.2z"/>
            <path d="M1673.9,895.6L1673.9,895.6c0,52.3-42.4,94.3-94.3,94.3H213c-52.3,0-94.3-42.4-94.3-94.3l0,0c0-52.3,42.4-94.3,94.3-94.3
                    h1366.6C1631.5,800.8,1673.9,843.2,1673.9,895.6z"/>
            <path d="M1673.9,427.9L1673.9,427.9c0,52.3-42.4,94.3-94.3,94.3H212.7c-52.3,0-94.3-42.4-94.3-94.3l0,0c0-52.3,42.4-94.3,94.3-94.3
                    h1366.8C1631.5,333.2,1673.9,375.6,1673.9,427.9z"/>
            </svg>
    </a>
    <!--
    <form class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form>
    -->
    <?php
    if($_SESSION["status"]=="administrator" || $_SESSION["status"]=="super_administrator"){
        ?>
        <?php
        $result = get("SELECT id FROM rides ORDER BY id DESC LIMIT 1");
        $row = $result->fetch_assoc();
        $last_ride_id = $row["id"];
        ?>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
            <span id="rideNotification" lride="<?php echo $last_ride_id; ?>">
                <span class="text-success">
                    No new rides
                </span>
                <!--
                <span class="text-danger">
                    <b>You have new rides</b>
                </span>
                -->
            </span>
            </div>
        </div>
        <?php
    }

    if($_SESSION["status"]=="driver"){
        ?>
        <?php
        /** @var Driver $driver */
        $driver_id = $driver->getId();

        if(is_numeric($driver_id)){
            $result = get("SELECT COUNT(*) AS id FROM rides WHERE driver_id=".$driver_id);
            $row = $result->fetch_assoc();

            if(!isset($row["id"])){
                $last_ride_id_driver = -1;
            }else{
                $last_ride_id_driver = $row["id"];
            }

            ?>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                <span id="rideNotificationDriver" lride="<?php echo $last_ride_id_driver; ?>" driver_id="<?php echo $driver->getId(); ?>">
                    <span class="text-success">
                        No new rides
                    </span>
                    <!--
                    <span class="text-danger">
                        <b>You have new rides</b>
                    </span>
                    -->
                </span>
                    </div>
                </div>
            <?php
        }
    }
    ?>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown translate">
            <svg class="translate_svg" width="30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="serbian" viewBox="0 0 640 480">
                <g clip-path="url(#a)" transform="translate(-32) scale(.53333)">
                    <path fill="#fff" d="M0 0h1350v900H0z"/>
                    <path fill="#0c4076" d="M0 0h1350v600H0z"/>
                    <path fill="#c6363c" d="M0 0h1350v300H0z"/>
                </g>
            </svg>
        </div>

        <div class="ms-3 nav-item dropdown translate">
            <svg class="translate_svg" width="30" xmlns="http://www.w3.org/2000/svg" id="english" viewBox="0 0 640 480">
                <path fill="#012169" d="M0 0h640v480H0z"/>
                <path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0h75z"/>
                <path fill="#C8102E" d="m424 281 216 159v40L369 281h55zm-184 20 6 35L54 480H0l240-179zM640 0v3L391 191l2-44L590 0h50zM0 0l239 176h-60L0 42V0z"/>
                <path fill="#FFF" d="M241 0v480h160V0H241zM0 160v160h640V160H0z"/>
                <path fill="#C8102E" d="M0 193v96h640v-96H0zM273 0v480h96V0h-96z"/>
            </svg>
        </div>

        <div class="ms-3 nav-item dropdown translate">
            <svg class="translate_svg" width="30" xmlns="http://www.w3.org/2000/svg" id="german" viewBox="0 0 640 480">
                <path fill="#ffce00" d="M0 320h640v160H0z"/>
                <path d="M0 0h640v160H0z"/>
                <path fill="#d00" d="M0 160h640v160H0z"/>
            </svg>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="">
                <?php
                    if($_SESSION["status"]=="administrator" || $_SESSION["status"]=="super_administrator"){
                        ?>
                        <span class="d-none d-lg-inline-flex">
                            <?php /** @var Admin $admin */
                            echo $admin->get_name()
                            ?> <?php echo $admin->getLast_name() ?></span>
                        <?php
                    }

                if($_SESSION["status"]=="driver"){
                    ?>
                    <span class="d-none d-lg-inline-flex">
                        <?php
                        /** @var Driver $driver */
                        echo $driver->getName();
                        ?> <?php echo $driver->getLastName(); ?></span>
                    <?php
                }
                ?>

            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <?php
                if($_SESSION["status"]=="driver"){
                    ?>
                    <div class="form-check form-switch">
                        <?php
                            if($driver->getStatus()=="active"){
                                ?>
                                <label class="form-check-label" for="change_driver_status" id="change_status_label">Status active</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="change_driver_status" checked="">
                                <?php
                            }else{
                                ?>
                                <label class="form-check-label" for="change_driver_status" id="change_status_label">Status unactive</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="change_driver_status">
                                <?php
                            }
                        ?>

                    </div>
                    <a href="driver-change-password" class="dropdown-item">
                        <span class="en">change password</span>
                        <span class="sr">promena lozinke</span>
                        <span class="de">Kennwort ändern</span>
                    </a>
                    <a href="assets/php/logout.php?driver" class="dropdown-item">
                        Log Out
                    </a>
                    <?php
                }else{
                    ?>
                    <a href="change-password" class="dropdown-item">
                        <span class="en">change password</span>
                        <span class="sr">promena lozinke</span>
                        <span class="de">Kennwort ändern</span>
                    </a>
                    <a href="assets/php/logout.php" class="dropdown-item">
                        <span class="en">log out</span>
                        <span class="sr">izloguj se</span>
                        <span class="de">Ausloggen</span>
                    </a>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</nav>