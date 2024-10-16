@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Activities</h5>
                    </div>
                    <div class="card-body p-2">
                        <div class="notifications-widget">
                            <!-- single notification -->
                            {{-- @php
                                $key = 1;
                            @endphp --}}
                            <div class="single-notification">
                              <ul class="list-group list-group-flush">
                                  @foreach ($activity as $item)
                                    <li class="list-group-item">
                                      <div class="d-flex w-100 justify-content-between">
                                        <p style="font-size: 13px" class="mb-0">{!!$item->message!!}</p>
                                        <small style="color: rgb(169, 171, 179)">{{date("F j, Y, g:i a",strtotime($item->created_at));}}</small>
                                      </div>
                                    </li>
                                  @endforeach
                              </ul>
                            </div>
                            {{ $activity->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection