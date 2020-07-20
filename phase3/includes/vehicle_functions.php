<?php
$vehicleObjects = ["car" => new Car(), "boat" => new Boat(), "plane" => new Plane()];

class VehicleFunction extends UtilFunction
{
    public function showHeader()
    {
        ?>
        <header>
            <h1>Vehicles of the World</h1>
            <?= $this->getTopNav() ?>
        </header>
        <?php
    }

    public function getTopNav()
    {
        ?>
        <nav class="menu">
                <ul>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=car">Car</a></li>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=boat">Boat</a></li>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=plane">Plane</a></li>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>">Start Over</a></li>
                </ul>
            </nav>
        <?php
    }

    public function getFooter()
    {
        return "<footer>&copy;2020 Christian Hur. I own this!</footer>";
    }

    public function startOver()
    {
        session_unset();
        session_destroy();
        echo "<h1>Pick A Vehicle Type Above</h1>";
    }

    public function showInvalid()
    {
        echo "<h3 class='error-messages'>Invalid option.</h3>";
    }

    public function createObject($type)
    {
        $obj = $this->getObj($type);
        if (isset($_GET['action'])) {
            $this->processAction($obj);
        }
        $_SESSION[$type] = serialize($obj);
        $obj->showInfo();
        $this->showActions($type);
    }

    public function showActions($obj)
    {
        ?>
        <div class="actions">
            <ul>
                <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=<?= $obj ?>&action=start">Start Engine</a></li>
                <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=<?= $obj ?>&action=stop">Stop Engine</a></li>
                <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=<?= $obj ?>&action=accelerate">Accelerate</a></li>
                <li><a href="<?= $_SERVER['PHP_SELF'] ?>?obj=<?= $obj ?>&action=brake">Brake</a></li>
            </ul>
        </div>
        <?php
    }

    public function processAction($obj)
    {
        echo "<h3 class='status'>";
        switch ($_GET['action']) {
            case 'start':
                $obj->startEngine();
                break;
            case 'stop':
                $obj->stopEngine();
                break;
            case 'accelerate':
                $obj->accelerate();
                break;
            case 'brake':
                $obj->brake();
                break;
        }
        echo "</h3>";
    }

    public function getObj($type)
    {
        global $vehicleObjects;
        if (isset($_SESSION[$type])) {
            return unserialize($_SESSION[$type]);
        } else {
            return $vehicleObjects[$type];
        }
    }
}