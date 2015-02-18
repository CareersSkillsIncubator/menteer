<main id="main" role="main">
    <div class="container">

        <?=$this->session->flashdata('message');?>

        <div align="center">
            <a href="/admin/cms">CMS</a> | <a href="/admin/survey">Survey</a>
        </div>
        <div align="center">
            <a href="https://menteer.uservoice.com" target="_blank">User Voice</a> |
            <a href="http://www.google.com/analytics" target="_blank">Google Analytics</a> |
            <a href="https://www.google.com/webmasters/tools/home?hl=en" target="_blank">Google Tools</a> |
            <a href="/admin/export">Export Users</a> |
            <a href="/logout">Logout</a>
        </div>

        <p>&nbsp;</p>

        <div style="clear:both;"></div>
        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($users);?></span>
                    Total Users
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($mentors);?></span>
                    Mentors
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($mentees);?></span>
                    Mentees
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($both);?></span>
                    Both
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($matched);?></span>
                    Total Matched
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($meetings);?></span>
                    # Meetings
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($tasks);?></span>
                    # Tasks
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-stacked" style="width:200px; float:left; margin-left:3px; margin-top: 3px;">
            <li class="active">
                <a href="#">
                    <span class="badge pull-right"><?=count($events);?></span>
                    # Events
                </a>
            </li>
        </ul>


        <link href="/assets/css/blue/style.css" rel="stylesheet">
        <script type="text/javascript" src="/assets/js/jquery.tablesorter.min.js"></script>

        <div style="clear:both;"></div>
        <table id="myTable" class="tablesorter" style="margin-top:15px;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Match Status</th>
                <th>Last Login</th>
                <th>Active</th>
                <th>Disabled</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($users as $user) { ?>

                <tr>
                    <td><a name="user<?=$user['id']?>" href="/dashboard/force/<?=encrypt_url($user['id']);?>"><?=$user['id']?></a></td>
                    <td><?=$user['last_name']?></td>
                    <td><?=$user['first_name']?></td>
                    <td><?=$user['email']?></td>
                    <td>

                        <?php
                        switch($user['menteer_type']){
                            case "38":
                                echo "Mentee";
                                break;
                            case "37" :
                                echo "Mentor";
                                break;
                            default:
                                echo "Both";
                        }

                        ?>

                    </td>

                    <td>

                        <?php
                        if($user['is_matched'] == 0)
                            echo " - ";

                        if($user['is_matched'] > 0 && $user['match_status'] == 'pending')
                            echo "awaiting (".$user['is_matched'].")";

                        if($user['match_status']=='active')
                            echo "matched (".$user['is_matched'].")";

                        ?>

                    </td>
                    <td><?=date("M d Y",$user['last_login'])?></td>

                    <?php
                        $act = "<a href=\"/admin/activate/".encrypt_url($user['id'])."\" onclick=\"return confirm('Are you sure you would like to activate this user?');\">activate</a>";
                    ?>

                    <td><?=$user['active']==1 ? 'Yes' : $act?></td>
                    <td><?=$user['enabled']==0 ? 'Yes' : 'No';?></td>
                </tr>

            <?php }
            ?>

            </tbody>
        </table>


        <script>
            $(document).ready(function()
                {
                    $("#myTable").tablesorter();
                }
            );
        </script>




    </div>
</main>