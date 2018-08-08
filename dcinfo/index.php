<?php 
include('header.php');
if(!isset($_GET['dc']))
{
    header("Location: index.php?dc=dc23");
}
?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartSVC);
      google.charts.setOnLoadCallback(drawChartCPU);
      google.charts.setOnLoadCallback(drawChartRAM);

      function drawChartSVC() {

        var data = google.visualization.arrayToDataTable([
          ['SVC', 'Storage'],
          <?php
          require("config.php");
          $dc = $_GET['dc'];
          $san_query = "select truncate(abs(sum(free_capacity)/1024/1024/1024/1024),2) as free_capacity,"
                  . " truncate(abs(sum(used_capacity)/1024/1024/1024/1024),2) as used_capacity"
                  . " from svc where dc_name='$dc'";
          $san_result = mysqli_query($db, $san_query);
          while($san_row = mysqli_fetch_assoc($san_result))
          {
              print "['Free Storage', {$san_row['free_capacity']}],\n";
              print "['Used Storage', {$san_row['used_capacity']}]\n";
          }
          ?>
        ]);

        var options = {
          title: 'Storage Utilization (TB)',
          is3D: true,
          colors: ["silver","teal"]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartsvc'));

        chart.draw(data, options);
      }
      
      function drawChartCPU() {

        var data = google.visualization.arrayToDataTable([
          ['CPU', 'Usage'],
          <?php
          require("config.php");
          $cpu_query = "select abs(sum(configurable_sys_proc_units) - sum(curr_avail_sys_proc_units)) as used_cpu,"
                  . " abs(sum(curr_avail_sys_proc_units)) as free_cpu"
                  . " from ms_cpu where ms_name like 'sysh___-%'";
          $cpu_result = mysqli_query($db, $cpu_query);
          while($cpu_row = mysqli_fetch_assoc($cpu_result))
          {
              print "['Free CPU', {$cpu_row['free_cpu']}],\n";
              print "['Used CPU', {$cpu_row['used_cpu']}]\n";
          }
          ?>
        ]);

        var options = {
          title: 'CPU Utilization',
          is3D: true,
          colors: ["green","navy"]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartcpu'));

        chart.draw(data, options);
      }
      
      function drawChartRAM() {

        var data = google.visualization.arrayToDataTable([
          ['Memory', 'Usage'],
          <?php
          require("config.php");
          $query = "select sum(curr_avail_sys_mem)/1024/1024 as free_mem, "
                  . "abs(sum(configurable_sys_mem/1024/1024) - sum(curr_avail_sys_mem/1024/1024)) as used_mem"
                  . " from ms_mem where ms_name like 'sysh___-%'";
          $result = mysqli_query($db, $query);
          while($row = mysqli_fetch_assoc($result))
          {
              print "['Free Memory', {$row['free_mem']}],\n";
              print "['Used Memory', {$row['used_mem']}]\n";
          }
          ?>
        ]);

        var options = {
          title: 'Memory Utilization (TB)',
          is3D: true,
          colors: ["gray","purple"]
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartram'));

        chart.draw(data, options);
      }
      
</script>
<div class="container" style="width: 100%">
     <div class="panel panel-info">
         <div class="panel-heading"><strong>Resource overview <?php print(strtoupper($_GET['dc'])); ?></strong></div>
            <div class="panel-body">
                
         <div class="row placeholders" style="border: 10px;">
            <div class="col-xs-6 col-sm-4 placeholder">
                <div id="piechartsvc" style="width: auto; height: 500px;"></div>
            </div>
             
            <div class="col-xs-6 col-sm-4 placeholder">
              <div id="piechartcpu" style="width: auto; height: 500px;"></div>
            </div>
             
            <div class="col-xs-6 col-sm-4 placeholder">
              <div id="piechartram" style="width: auto; height: 500px;"></div>
            </div>
          </div>
                
                <div class="container" style="width: 50%; float:left">
                    
                    <!-- STORAGE PART -->
                    
                    
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>SVC</th>
                        <th>Total Storage (TB)</th>
                        <th>Used Storage (TB)</th>
                        <th>Free Storage (TB)</th>
                        <th>Percentage Used %</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require("config.php");
                        $dc = $_GET['dc'];
                        $san_query = "  SELECT svc,
                                        SUM(TRUNCATE(( capacity / 1024 / 1024 / 1024 / 1024 ), 2))          AS
                                        total_capacity,
                                        SUM(TRUNCATE(( free_capacity / 1024 / 1024 / 1024 / 1024 ), 2))     AS
                                        free_capacity,
                                        SUM(TRUNCATE(( used_capacity / 1024 / 1024 / 1024 / 1024 ), 2))     AS
                                        used_capacity,
                                        TRUNCATE(SUM(TRUNCATE(( used_capacity / 1024 / 1024 / 1024 / 1024 ), 2))
                                                 * 100 /
                                                 SUM(
                                                 TRUNCATE(( capacity / 1024 / 1024 / 1024 / 1024 ), 2)), 2) AS
                                                 used_percentage
                                        FROM   svc
                                        WHERE  dc_name = '$dc'
                                        GROUP  BY svc";
                        $san_result = mysqli_query($db, $san_query);
                        while($row = mysqli_fetch_assoc($san_result))
                        {
                            print "<tr>";
                            print "<td><a href=\"svc.php?svc={$row['svc']}\" onclick=\"return popitup('svc.php?svc={$row['svc']}')\">{$row['svc']}</a></td>";
                            print "<td>{$row['total_capacity']}</td>";
                            print "<td>{$row['used_capacity']}</td>";
                            print "<td>{$row['free_capacity']}</td>";
                            print "<td>";
                            print "<div class=\"progress\">";
                            if($row['used_percentage'] < 70)
                            {
                                print "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 70 && $row['used_percentage'] < 95)
                            {
                                print "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 95)
                            {
                                print "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            print "</div>";
                            print "</td>";
                            print "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                
                <!-- CPU for all MS PART Overview -->
                
                <div class="container" style="width:50%; float:right">
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Total CPU</th>
                        <th>Used CPU</th>
                        <th>Free CPU</th>
                        <th>Percentage Used %</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        require("config.php");
                        $cpu_query = "  SELECT Abs(SUM(configurable_sys_proc_units)) AS
                                        total_cpu,
                                        truncate(Abs(SUM(curr_avail_sys_proc_units)),2) AS
                                        free_cpu,
                                        Abs(SUM(configurable_sys_proc_units) - SUM(curr_avail_sys_proc_units)) AS
                                        used_cpu,
                                        TRUNCATE(Abs(SUM(configurable_sys_proc_units) - SUM(
                                                     curr_avail_sys_proc_units))
                                                 * 100 /
                                                 Abs(SUM(configurable_sys_proc_units)), 2) AS
                                        used_percentage
                                        FROM   ms_cpu
                                        WHERE  ms_name LIKE 'sysh___-%' ";
                        $cpu_result = mysqli_query($db, $cpu_query);
                        while($row = mysqli_fetch_assoc($cpu_result))
                        {
                            print "<tr>";
                            print "<td>{$row['total_cpu']}</td>";
                            print "<td>{$row['used_cpu']}</td>";
                            print "<td>{$row['free_cpu']}</td>";
                            print "<td>";
                            print "<div class=\"progress\">";
                            if($row['used_percentage'] < 70)
                            {
                                print "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 70 && $row['used_percentage'] < 95)
                            {
                                print "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 95)
                            {
                                print "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            print "</div>";
                            print "</td>";
                            print "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                    
                <!-- Memory for all MS PART Overview -->
                
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Total Memory (TB)</th>
                        <th>Used Memory (TB)</th>
                        <th>Free Memory (TB)</th>
                        <th>Percentage Used %</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require("config.php");
                        $mem_query = "select truncate(sum(curr_avail_sys_mem)/1024/1024,2) as free_mem,"
                                    . " truncate((sum(configurable_sys_mem/1024/1024) - sum(curr_avail_sys_mem/1024/1024)),2) as used_mem,"
                                    . " sum(configurable_sys_mem)/1024/1024 as total_mem,"
                                    . " truncate(((sum(configurable_sys_mem) - sum(curr_avail_sys_mem)) * 100) / sum(configurable_sys_mem),2) as used_percentage"
                                    . " from ms_mem where ms_name like 'sysh___-%'";
                        $mem_result = mysqli_query($db, $mem_query);
                        while($row = mysqli_fetch_assoc($mem_result))
                        {
                            print "<tr>";
                            print "<td>{$row['total_mem']}</td>";
                            print "<td>{$row['used_mem']}</td>";
                            print "<td>{$row['free_mem']}</td>";
                            print "<td>";
                            print "<div class=\"progress\">";
                            if($row['used_percentage'] < 70)
                            {
                                print "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 70 && $row['used_percentage'] < 95)
                            {
                                print "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            elseif($row['used_percentage'] >= 95)
                            {
                                print "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"{$row['used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['used_percentage']}%\">{$row['used_percentage']}%</div>";
                            }
                            print "</div>";
                            print "</td>";
                            print "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                
                <!-- CPU and Memory for each MS PART Overview -->
                
                <div class="container" style="width:100%">
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Managed System</th>
                        <th>Total Memory (GB)</th>
                        <th>Used Memory (GB)</th>
                        <th>Free Memory (GB)</th>
                        <th>Percentage Memory Used %</th>
                        <th>Total CPU</th>
                        <th>Used CPU</th>
                        <th>Free CPU</th>
                        <th>Percentage CPU Used %</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        require("config.php");
                        $query = "select ms_mem.ms_name,truncate(sum(ms_mem.curr_avail_sys_mem)/1024,2) as free_mem, truncate((sum(ms_mem.configurable_sys_mem/1024) - sum(ms_mem.curr_avail_sys_mem/1024)),2) as used_mem, sum(ms_mem.configurable_sys_mem)/1024 as total_mem, truncate(((sum(ms_mem.configurable_sys_mem) - sum(ms_mem.curr_avail_sys_mem)) * 100) / sum(ms_mem.configurable_sys_mem),2) as mem_used_percentage, Abs(SUM(ms_cpu.configurable_sys_proc_units)) AS total_cpu, Abs(SUM(ms_cpu.curr_avail_sys_proc_units)) AS free_cpu, Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) * 100 / Abs(SUM(ms_cpu.configurable_sys_proc_units)), 2) AS cpu_used_percentage from ms_mem inner join ms_cpu on ms_mem.ms_name=ms_cpu.ms_name where ms_mem.ms_name like 'sysh___-%' group by ms_mem.ms_name ";
                        $result = mysqli_query($db, $query);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            print "<tr>";
                            print "<td><a href=\"ms.php?ms={$row['ms_name']}\" onclick=\"return popitup('ms.php?ms={$row['ms_name']}')\">{$row['ms_name']}</a></td>";
                            print "<td>{$row['total_mem']}</td>";
                            print "<td>{$row['used_mem']}</td>";
                            print "<td>{$row['free_mem']}</td>";
                            
                            print "<td>";
                            print "<div class=\"progress\">";
                            if($row['mem_used_percentage'] < 70)
                            {
                                print "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$row['mem_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['mem_used_percentage']}%\">{$row['mem_used_percentage']}%</div>";
                            }
                            elseif($row['mem_used_percentage'] >= 70 && $row['mem_used_percentage'] < 95)
                            {
                                print "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"{$row['mem_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['mem_used_percentage']}%\">{$row['mem_used_percentage']}%</div>";
                            }
                            elseif($row['mem_used_percentage'] >= 95)
                            {
                                print "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"{$row['mem_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['mem_used_percentage']}%\">{$row['mem_used_percentage']}%</div>";
                            }
                            print "</div>";
                            print "</td>";
                            
                            print "<td>{$row['total_cpu']}</td>";
                            print "<td>{$row['used_cpu']}</td>";
                            print "<td>{$row['free_cpu']}</td>";
                            print "<td>";
                            print "<div class=\"progress\">";
                            if($row['cpu_used_percentage'] < 70)
                            {
                                print "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$row['cpu_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['cpu_used_percentage']}%\">{$row['cpu_used_percentage']}%</div>";
                            }
                            elseif($row['cpu_used_percentage'] >= 70 && $row['cpu_used_percentage'] < 95)
                            {
                                print "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"{$row['cpu_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['cpu_used_percentage']}%\">{$row['cpu_used_percentage']}%</div>";
                            }
                            elseif($row['cpu_used_percentage'] >= 95)
                            {
                                print "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"{$row['cpu_used_percentage']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$row['cpu_used_percentage']}%\">{$row['cpu_used_percentage']}%</div>";
                            }
                            print "</div>";
                            print "</td>";
                            print "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                
            </div>
     </div>
</div>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
