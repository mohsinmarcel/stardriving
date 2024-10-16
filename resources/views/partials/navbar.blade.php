<ul class="metismenu side-nav">

    <li class="side-nav-title side-nav-item">Navigation</li>

    <li class="side-nav-item">
        <a href="/" class="side-nav-link active">
            <i class="uil-calender"></i>
            <span> Dashboard </span>
        </a>
    </li>

    @if(auth()->user()->can('student-view') || auth()->user()->can('student-create') || auth()->user()->can('student-edit') || auth()->user()->can('student-delete'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-user-circle"></i>
                <span> Students </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('student-view') || auth()->user()->can('student-edit') || auth()->user()->can('student-delete'))
                    <li>
                        <a href="{{route('students.index')}}">View Students</a>
                    </li>
                @endif
                @can('student-create')
                    <li>
                        <a href="{{route('students.create')}}">Add Student</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif

    @if(auth()->user()->can('student-view') || auth()->user()->can('student-create') || auth()->user()->can('student-edit') || auth()->user()->can('student-delete'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-user-circle"></i>
                <span>Extra Students </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('student-view') || auth()->user()->can('student-edit') || auth()->user()->can('student-delete'))
                    <li>
                        <a href="{{route('extrastudents.index')}}">View Extra Students</a>
                    </li>
                @endif
                @can('student-create')
                    <li>
                        <a href="{{route('extrastudents.create')}}">Add Extra Student</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif


    @if(auth()->user()->can('teacher-view') || auth()->user()->can('teacher-create') || auth()->user()->can('teacher-edit') || auth()->user()->can('teacher-delete'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-user"></i>
                <span> Teachers </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('teacher-view') || auth()->user()->can('teacher-edit') || auth()->user()->can('teacher-delete'))
                    <li>
                        <a href="{{route('teachers.index')}}">View Teachers</a>
                    </li>
                @endif
                @can('teacher-create')
                    <li>
                        <a href="{{route('teachers.create')}}">Add Teacher</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif
    @can('payment-view')
        <li class="side-nav-item">
            <a href="{{route('student-payments.index')}}" class="side-nav-link active">
                <i class="uil-usd-circle"></i>
                <span> Payments </span>
            </a>
        </li>
    @endcan

    @if(auth()->user()->can('attendance-view'))
        <li class="side-nav-item">
            <a href="{{route('student-attendance.index')}}" class="side-nav-link active">
                <i class="uil-presentation-check"></i>
                <span> Attendance </span>
            </a>
        </li>        
    @endif
    @if(auth()->user()->can('exams-view') || auth()->user()->can('exams-create') || auth()->user()->can('exams-edit') || auth()->user()->can('exams-delete'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-book-alt"></i>
                <span> Module 5 Exam </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('exams-view') || auth()->user()->can('exams-edit') || auth()->user()->can('exams-delete'))
                    <li>
                        <a href="{{route('exams.index')}}">View Exams</a>
                    </li>
                @endif
            @can('exams-create')
                <li>
                    <a href="{{route('exams.create')}}">Add Exam</a>
                </li>
            @endcan
            @can('exam-types-view')
                <li>
                    <a href="{{route('exam-types.index')}}">Exam Type</a>
                </li>
            @endcan
            </ul>
        </li>
    @endif

    @if(auth()->user()->can('session-evaluation-view') || auth()->user()->can('session-evaluation-edit') || auth()->user()->can('session-evaluation-show') || auth()->user()->can('session-evaluation-delete'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-telescope"></i>
                <span> Self Evaluation </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('session-evaluation-view') || auth()->user()->can('session-evaluation-create'))
                    <li>
                        <a href="{{route('student-session-evaluation.index')}}">View Self Evaluation</a>
                    </li>
                @endif
                @can('session-evaluation-create')
                <li class="side-nav-item">
                    <a href="{{route('student-session-evaluation.create')}}">Add Self Evaluation</a>
                </li>
                @endcan
                @if (auth()->user()->can('session-evaluation-view'))
                    <li class="side-nav-item">
                        <a href="{{route('evaluation-types.index')}}">
                            <span> Evaluation Criteria </span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(auth()->user()->can('class-modules-view'))
        <li class="side-nav-item">
            <a href="{{route('class-modules.index')}}" class="side-nav-link active">
                <i class="uil-diary"></i>
                <span> Modules </span>
            </a>
        </li>        
    @endif

    @if(auth()->user()->can('rates-view') || auth()->user()->can('rates-edit'))
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-usd-circle"></i>
                <span> Rates </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('rates-view') || auth()->user()->can('rates-edit'))
                    <li>
                        <a href="{{route('rates.index')}}">Course Price</a>
                    </li>
                @endif
                @can('charges-types-view')
                <li class="side-nav-item">
                    <a href="{{route('charges-types.index')}}">Extra Charges</a>
                </li>
            @endcan
            </ul>
        </li>
    @endif

    @role('admin')
    <li class="side-nav-item">
        <a href="{{route('settings')}}" class="side-nav-link active">
            <i class="mdi mdi-account-settings-outline"></i>
            <span> Settings </span>
        </a>
    </li>
    @endrole

    @role('admin')
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="mdi mdi-account-multiple-outline"></i>
                <span> Users </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li>
                    <a href="{{route('users.index')}}">View Users</a>
                </li>
                <li>
                    <a href="{{route('users.create')}}">Add User</a>
                </li>
            </ul>
        </li>
    @endrole
    @if (auth()->user()->can('report-medical') || auth()->user()->can('report-phaseone-certificate') || auth()->user()->can('report-final-certificate') || auth()->user()->can('report-contract') || auth()->user()->can('report-exam') || auth()->user()->can('report-attendance') || auth()->user()->can('report-evaluation'))
        <li class="side-nav-item">
            <a href="{{route('reports.create')}}" class="side-nav-link active">
                <i class="uil-files-landscapes"></i>
                <span> Reports </span>
            </a>
        </li>
    @endif
    @if (auth()->user()->can('import') || auth()->user()->can('export'))
    <li class="side-nav-item">
        <a href="{{route('import-export.import')}}" class="side-nav-link active">
            <i class="mdi mdi-file-import-outline"></i>
            <span> Import/Export </span>
        </a>
    </li>
    @endif
    @if (auth()->user()->can('backup-view'))
    <li class="side-nav-item">
        <a href="{{route('database-backup')}}" class="side-nav-link active">
            <i class="mdi mdi-file-import-outline"></i>
            <span> Backup Files </span>
        </a>
    </li>
    @endif

    <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil-book-alt"></i>
                <span> Accounting </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                @if(auth()->user()->can('exams-view') || auth()->user()->can('exams-edit') || auth()->user()->can('exams-delete'))
                    <li>
                        <a href="{{route('transections.index')}}">Transections</a>
                    </li>
                @endif
                <li>
                    <a href="{{route('supplier.index')}}">Add Suppliers</a>
                </li>
            <li>
                    <a href="{{route('quarters.index')}}">Add Quarters</a>
                </li>
            </ul>
        </li>
</ul>