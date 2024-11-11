@extends('layout.app')
@section('content')
    <style>
        .apexcharts-text tspan {
            color: #000000;
        }

        .card-body {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }

        .past-day {
            position: relative;
        }

        .past-day::before {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            color: #ff0000;
        }

        .fc-day.past-day {
            pointer-events: none;
            background-color: #f0f0f0;
        }

        .blockout-day {
            background-color: #bdbbbb;
            pointer-events: none;
        }

        .row.mb-4 {
            justify-content: center;
        }

        .hidden {
            display: none !important;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically if needed */
            width: 100%;
            /* Full width */
        }

        #calendar {
            width: 65%;
            /* Adjust this percentage as needed */
            transform: scale(1);
            /* Scale the calendar size */
            transform-origin: center;
            overflow: hidden;
            font-size: 13px;
        }
    </style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="centered-container">
                            <div id='calendar'>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
            </div>
            <!-- Recent Activities Widget -->
            @hasrole('admin')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Recent Activities</h5>
                        </div>
                        <div class="card-body p-2">
                            <div class="notifications-widget">
                                <!-- single notification -->
                                <div class="single-notification">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($activity as $item)
                                            <li class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <p style="font-size: 13px" class="mb-0">{!! $item->message !!}</p>
                                                    <small
                                                        style="color: rgb(169, 171, 179)">{{ date('F j, Y, g:i a', strtotime($item->created_at)) }}</small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if ($activity->count() > 0)
                            <div class="card-footer" style="text-align: center">
                                <a href="{{ route('activity-logs-view') }}" class="btn btn-link text-center"><strong>Show
                                        All</strong></a>
                            </div>
                        @else
                            <div class="card-footer" style="text-align: center">
                                <p style="font-size: 15px"><b>No Activities to show</b></p>
                            </div>
                        @endif
                    </div>
                </div>
            @endhasrole
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- Passed -->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $passed_students }}</h3>
                                    <h5 class="mt-0" title="PASSED STUDENTS">PASSED STUDENTS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TODAY'S DRIVING HOURS -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-clock-outline widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $getTodayDrivingHours }}</h3>
                                    <h5 class="mt-0" title="TODAY'S PAID AMOUNT">TODAY'S DRIVING HOURS </h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TODAY'S PAID AMOUNT -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">$ {{ $getTodayPaidAmount }}</h3>
                                    <h5 class=" mt-0" title="TODAY'S PAID AMOUNT">TODAY'S PAID AMOUNT</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- REMAINING STUDENTS -->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $remaining_students }}</h3>
                                    <h5 class="mt-0" title="REMAINING STUDENTS">REMAINING STUDENTS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- REMAINING DRIVING HOURS -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-clock-outline widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $getRemainingDrivingHours }}</h3>
                                    <h5 class=" mt-0" title="TODAY'S PAID AMOUNT">REMAINING DRIVING HOURS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TOTAL REMAINING AMOUNT -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">$ {{ $getTotalRemainingAmount }}</h3>
                                    <h5 class="mt-0" title="TOTAL REMAINING AMOUNT">TOTAL REMAINING AMOUNT</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- Completed Driving Hours -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $extrastudents }}</h3>
                                    <h5 class="mt-0" title="EXTRA STUDENTS">EXTRA STUDENTS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- Extra Student AMOUNT -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-clock-outline widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $getCompletedDrivingHours }}</h3>
                                    <h5 class="mt-0" title="COMPLETED DRIVING HOURS">COMPLETED DRIVING HOURS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TOTAL PAID AMOUNT -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">$ {{ $getTotalPaidAmount }}</h3>
                                    <h5 class=" mt-0" title="TOTAL PAID AMOUNT">TOTAL PAID AMOUNT</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TOTAL STUDENTS -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $students }}</h3>
                                    <h5 class="mt-0" title="TOTAL COURSE STUDENTS">TOTAL COURSE STUDENTS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TOTAL DRIVING HOURS -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-clock-outline widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">{{ $getTotalDrivingHours }}</h3>
                                    <h5 class=" mt-0" title="TODAY'S PAID AMOUNT">TOTAL DRIVING HOURS</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- TOTAL AMOUNT -->
                        <!-- end col-->
                        <div class="col-lg-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h3 class="text-muted font-weight-normal mb-3">$
                                        {{ $getTotalPaidAmount + $getTotalRemainingAmount }}</h3>
                                    <h5 class=" mt-0" title="TOTAL PAID AMOUNT">TOTAL AMOUNT</h5>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>
                        <!-- end col-->
                    </div>
                </div>
                <!-- Existing content... -->
                <div class="col-md-12">
                    <div class="row">
                        <!-- Upcoming Theory Exams Widget -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5>Upcoming Theory Exams</h5>
                                        <div class="form-group">
                                            <label for="theoryExamRecords">Show Last:</label>
                                            <select id="theoryExamRecords" class="form-control"
                                                onchange="changeTheoryExamRecords(this.value)">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" id="upcomingTheoryExamsList">
                                        @foreach ($upcomingTheoryExams as $exam)
                                            <li class="list-group-item">
                                                {{ $exam->getFullNameAttribute() }} - {{ $exam->theroy_exam_date }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Upcoming Knowledge Tests Widget -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5>Upcoming Knowledge Tests</h5>
                                        <div class="form-group">
                                            <label for="knowledgeTestRecords">Show Last:</label>
                                            <select id="knowledgeTestRecords" class="form-control"
                                                onchange="changeKnowledgeTestRecords(this.value)">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" id="upcomingKnowledgeTestsList">
                                        @foreach ($upcomingKnowledgeTests as $test)
                                            <li class="list-group-item">
                                                {{ $test->getFullNameAttribute() }} - {{ $test->knowledge_test_date }}
                                                {{ date('h:i A', strtotime($test->knowledge_test_time)) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Remaining content... -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>STUDENT STATUS</h4>
                            <!-- <div id="student-status" class="apex-charts" data-colors="#ffbc00"></div> -->
                            <canvas id="student-status" style="width:100%;height:100%"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>STUDENT TYPE</h4>
                            <!-- <div id="student-chart" class="apex-charts" data-colors="#ffbc00"></div> -->
                            <canvas id="student-chart" style="width:100%;height:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>New Student Last 7 Days</h4>
                            <div id="line-chart" class="apex-charts" data-colors="#ffbc00"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Last 12 Months Payment History</h4>
                            <div id="payment-chart" class="apex-charts" data-colors="#ffbc00"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    @include('partials.delete-alert-modal')
    @include('partials._modal')
@endsection
@push('scripts')
    <script src="assets/js/vendor/apexcharts.min.js"></script>
    <script src="assets/js/pages/demo.apex-line.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="{{ asset('assets/js/customs/attendance-script.js') }}"></script>
    <script>
        var jsonData = JSON.parse(@json($last_week_students))
        var studentData = JSON.parse(@json($studentTypeCount))
        var paymentData = JSON.parse(@json($getTwelveMonthPaymentHistory))
        var studentStatuses = JSON.parse(@json($student_status_count))
        var SITEURL = "{{ url('/') }}";
        var options = {
            series: [{
                name: "Student Count",
                data: jsonData.map(x => x.students_count)
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            colors: ["#f14242"],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            // title: {
            //   text: 'New Students Last 7 Days',
            //   align: 'left'
            // },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: jsonData.map(x => x.days),
            }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart"), options);
        chart.render();

        var studentOptions = {
            colors: ["#FA5C7C", '#FF8B8B'],
            // title: {
            //     text: 'STUDENT TYPE',
            //     align: 'left'
            // },
            series: studentData.map(x => x.student_count),
            chart: {
                width: 420,
                height: 350,
                type: 'pie',
            },
            dataLabels: {
                style: {
                    colors: ['#000000']
                }
            },
            labels: studentData.map(x => (x.student_type.charAt(0).toUpperCase() + x.student_type.slice(1))),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var studentChart = new ApexCharts(document.querySelector("#student-chart"), studentOptions);
        studentChart.render();

        new Chart("student-chart", {
            type: "pie",
            data: {
                labels: studentData.map(x => (x.student_type.charAt(0).toUpperCase() + x.student_type.slice(1))),
                datasets: [{
                    backgroundColor: ["#FA5C7C", '#FF8B8B'],
                    data: studentData.map(x => x.student_count)
                }]
            },
            options: {
                title: {
                    display: true
                }
            }
        });

        var optionsPayment = {
            series: [{
                    name: 'Paid Amount',
                    data: paymentData.map(x => x.amount)
                }
                // ,{
                //   name: 'series2',
                //   data: [11, 32, 45, 32, 34, 52, 41]
                // }
            ],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                    enabled: false
                }
            },
            colors: ["#f14242"],
            // title: {
            //   text: 'Last 12 Months Payment History',
            //   align: 'left'
            // },
            dataLabels: {
                enabled: false,
                style: {
                    colors: ['#000000']
                }
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                //   type: 'datetime',
                categories: paymentData.map(x => x.month_year)
            }
        };

        var chartPayment = new ApexCharts(document.querySelector("#payment-chart"), optionsPayment);
        chartPayment.render();

        // Student Statuses Chart start
        var studentOptions = {
            colors: ["#f14242", "#FA5C7C", '#FF8B8B', '#FFDEDE'],
            // title: {
            //     text: 'STUDENTS STATUS',
            //     align: 'left'
            // },
            series: studentStatuses.map(x => x.student_count),
            chart: {
                width: 450,
                height: 350,
                type: 'pie',
            },
            labels: studentStatuses.map(x => (x.student_status.charAt(0).toUpperCase() + x.student_status.slice(1))),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var studentChart = new ApexCharts(document.querySelector("#student-status"), studentOptions);
        studentChart.render();

        new Chart("student-status", {
            type: "pie",
            data: {
                labels: studentStatuses.map(x => (x.student_status.charAt(0).toUpperCase() + x.student_status.slice(
                    1))),
                datasets: [{
                    backgroundColor: ["#f14242", "#FA5C7C", '#FF8B8B', '#FFDEDE'],
                    data: studentStatuses.map(x => x.student_count)
                }]
            },
            options: {
                title: {
                    display: true
                }
            }
        });
        // Student Statuses chart end
        var calendar = $('#calendar').fullCalendar({
            events: SITEURL + "/fullcalender",
            dayRender: function(date, cell) {
                // if (date.isBefore(moment(), 'day')) {
                //     cell.addClass('past-day');
                // }

                var currentDate = date.format('YYYY-MM-DD');

                // // Add tooltip with data on hover
                // cell.attr('title', 'Custom data for ' + currentDate); // You can customize this with any data
                // cell.tooltip({
                //     placement: 'top', // Position of the tooltip
                //     trigger: 'hover',
                //     container: 'body'
                // });
            },
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            dayClick: function(date, jsEvent, view) {
                // Remove old date click condition, allow click on any date
                // Open the modal on day click
                $('#frontPagesModal').modal('show');

                // Set the value of the attendance_date input field
                $.get("/student-attendance/create", function(data) {
                    $('#frontPagesModal .modal-dialog').addClass('modal-lg');
                    $('#frontPagesModal .modal-content').html(data);
                    $('#student, #teacher, #class_type, #class_module').select2();
                    $('#attendance_date').val(date.format('YYYY-MM-DD'));

                    // Load additional form data if needed
                    $('#frontPagesModal .modal-content').on('change', '#class_type', function() {
                        getModules($(this).val());
                    });
                });
            },
            eventMouseover: function(event, jsEvent, view) {
                // Tooltip for events
                $(this).tooltip({
                    title: event.title, // Show event title or custom text
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            }
        });


        function getModules(classType) {
            let modules = @json($class_modules);
            $('#class_module').empty();
            $('#class_module').html("<option value>--Select Module--</option>");
            for (let item of modules) {
                if (item.class_type_id == classType) {
                    let isSelected = {{ old('class_module') ?? 0 }} == item.id ? 'selected' : ''
                    $('#class_module').append("<option value='" + item.id + "' " + isSelected + ">" + item.name +
                        "</option>")
                }
            }

            $(document).on('change', '#class_type', function() {
                getModules($(this).val())
            })
            // $('#class_module').
            // console.log(modules);
        }


        function changeTheoryExamRecords(records) {
            fetchUpcomingExams('theroy', records);
        }

        function changeKnowledgeTestRecords(records) {
            fetchUpcomingExams('knowledge', records);
        }

        function fetchUpcomingExams(type, records) {
            fetch(`/api/upcoming-exams?type=${type}&records=${records}`)
                .then(response => response.json())
                .then(data => {
                    const listId = type === 'theroy' ? 'upcomingTheoryExamsList' : 'upcomingKnowledgeTestsList';
                    const list = document.getElementById(listId);
                    list.innerHTML = '';

                    data.forEach(exam => {
                        console.log(exam)
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';

                        const examDate = type === 'knowledge' ? exam.knowledge_test_date : exam
                        .theroy_exam_date;
                        const examTime = type === 'knowledge' ? ` ${formatTime(exam.knowledge_test_time)}` : '';


                        listItem.textContent = type === 'knowledge' ?
                            `${exam.first_name} ${exam.last_name} - ${examDate} ${examTime}` :
                            `${exam.first_name} ${exam.last_name} - ${examDate}`;
                        list.appendChild(listItem);
                    });
                })
                .catch(error => console.error('Error fetching upcoming exams:', error));
        }

        function formatTime(time) {
            const formattedTime = new Date(`1970-01-01T${time}Z`).toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
            return formattedTime;
        }
    </script>
@endpush
