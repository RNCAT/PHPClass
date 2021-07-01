<?php
include_once './templates/header.php';
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>

<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable()
    })
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TUS CONTROL PEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./table/employee.php">พนักงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./table/emp_type.php">ประเภทพนักงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./table/work_type.php">ประเภทงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./table/department.php">แผนก</a>
                </li>
            </ul>
            <form class="d-flex">
                <a class="nav-link" style="color: white;">ชื่อผู้ใช้ : <?php echo $_SESSION['username'] ?></a>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </form>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-4 col-sm-1">
            <div class="card">
                <h4 style="text-align: center; margin: 15px;">ประเภทพนักงาน</h4>
                <div class="card-body">
                    <canvas id="graphEmpType" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-1">
            <div class="card">
                <h4 style="text-align: center; margin: 15px;">ประเภทงาน</h4>
                <div class="card-body">
                    <canvas id="graphWorkType" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-1">
            <div class="card">
                <h4 style="text-align: center; margin: 15px;">แผนก</h4>
                <div class="card-body">
                    <canvas id="graphDept" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        showGraphWorkType()
        showGraphEmpType()
        showGraphDept()
    })
    const color = [
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)'
    ]
    const borderColor = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ]

    function showGraphWorkType() {
        {
            $.post("graph_work_type.php",
                function(data) {
                    console.log(data)
                    let name = []
                    let marks = []

                    for (let i in data) {
                        name.push(data[i].work_type_name);
                        marks.push(data[i].count_work);
                    }

                    let chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'ประเภทงาน',
                            backgroundColor: color,
                            borderColor: borderColor,
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }]
                    };

                    let graphTarget = $("#graphWorkType");

                    let barGraph = new Chart(graphTarget, {
                        type: 'pie',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    })
                })
        }
    }

    function showGraphEmpType() {
        {
            $.post("graph_emp_type.php",
                function(data) {
                    console.log(data)
                    let name = []
                    let marks = []

                    for (let i in data) {
                        name.push(data[i].emp_type)
                        marks.push(data[i].count_work)
                    }

                    let chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'ประเภทพนักงาน',
                            backgroundColor: color,
                            borderColor: borderColor,
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }]
                    }

                    let graphTarget = $("#graphEmpType")

                    let barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    })
                })
        }
    }

    function showGraphDept() {
        {
            $.post("graph_dept.php",
                function(data) {
                    console.log(data)
                    let name = []
                    let marks = []

                    for (let i in data) {
                        name.push(data[i].dept_name)
                        marks.push(data[i].count_dept)
                    }

                    let chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'ประเภทพนักงาน',
                            backgroundColor: color,
                            borderColor: borderColor,
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }]
                    };

                    let graphTarget = $("#graphDept")

                    let barGraph = new Chart(graphTarget, {
                        type: 'doughnut',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    })
                })
        }
    }
</script>