@extends('admin.master')
@section('all')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Support Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

{{-- <div class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><b>{{ 'Balance' }} </b><i class="fas fa-dollar-sign"> {{ Auth::user()->balance }} </i></div> <br>  <br> --}}
    <h4 class="card-title"> Ticket In Progress </h4>
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr>
              <td>Sn</td>
              <td>Ticket Number</td>
              <td>Subject</td>
              <td>My Device</td>
              <td>Date Of Issue</td>
              <td>Date of Submittion</td>
              <td>Status</td>
              <td>Action</td>

            </thead>
            <tbody>


                @foreach($data as $key => $item)

                <tr>
                    <td> {{ $key+1}} </td>
                    <td class="text-center">{{ $item->ticket_no}}</td>
                    <td class="text-center">{{ $item->subject}}</td>
                    <td class="text-center">{{ $item->device}}</td>
                    {{-- <td class="text-center">{{ $item->checkin_date }}</td> --}}
                    <td class="text-center"> {{ date('d-m-Y',strtotime($item->date))  }} </td>
                    <td class="text-center"> {{ ($item->created_at)  }} </td>


                            {{-- <td class="text-right">
                                @php
                                $d1 = explode('/',$item->checkin_date);
                                $d2 = explode('/',$item->checkout_date);
                                $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                $t1 = strtotime($d1_new);
                                $t2 = strtotime($d2_new);
                                $diff = ($t2-$t1)/60/60/24;
                                @endphp

                            </td> --}}

                            <td>
                                @if($item->status == '0')
                                <span class="ri-checkbox-blank-circle-fill font-size-12 align-middle btn btn-warning">Pend</span>
                                @elseif($item->status == '1')
                                <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-secondary align-middle me-2">In Progress</span>
                                @elseif($item->status == '2')
                                <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-success align-middle me-2">Approved</span>
                                @elseif($item->status == '4')
                                <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-danger align-middle me-2">Rejected</span>
                                @endif
                             </td>

                        <td>
             <a href="{{ route('admin.support.R', $item->id) }} " class="btn btn-success sm" title="Approved" id="ApproveBtn">  <i class="fas fa-check-circle"></i> </a>
                <a href="{{ route('admin.support.veiw', $item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-eye"></i> </a>
                <a href="{{ route('admin.support.delete', $item->id) }}" class="btn btn-danger sm" title="" id="">  <i class="fas fa-trash-alt"></i> </a>

            </td> 
        </tr>
        @endforeach
        </tbody>
    </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>





@endsection

