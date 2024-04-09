@extends('user.master')
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
<div class="col-12 ">
<div class="card">
<div class="card-body">

{{-- <div class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><b class="mx-2">{{ 'Balance' }} </b><i class="fas fa-dollar-sign"> {{ auth()->user()->balance }} </i></div> <br>  <br> --}}

<h4 class="card-title"> Ticket History </h4>
    
    <div class="table-responsive">
                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                    <thead class="table-light">
                        <tr>
                                              
                              <th >Sn</td>
                              <th >Ticket Number</td>
                              <th >Subject</td>
                              <th >My Device</td>
                              <th scope="col">Date Of Issue</td>
                              <th >Date of Submittion</td>
                              <th >Status</td>
                              <td>Action</td>
              
                             <!--<th style="width: 120px;">Salary</th>-->
                        </tr>
                    </thead><!-- end thead -->
    
            <tbody>


                @foreach($data as $key => $item)

                <tr>
                    <td><h6 class="mb-0">{{ $key+1}}</h6></td>
                    <td><h6 class="mb-0">{{ $item->ticket_no}}</h6></td>
                   
                    <td><h6 class="mb-0">{{ $item->subject}}</h6></td>
                     <td><h6 class="mb-0">{{ $item->device}}</h6></td>
                    <td><h6 class="mb-0">{{ $item->checkin_date }}</h6></td>
                    <!--<td><h6 class="mb-0"> {{ date('d-m-Y',strtotime($item->date))  }}</h6></td>-->
                    <td><h6 class="mb-0">{{ $item->created_at}}</h6></td>
                    
                    
                <!--<td>-->
                <!--    @if($item->status == '0')-->
                <!--    <span class="ri-checkbox-blank-circle-fill font-size-12 align-middle btn btn-warning">Pending</span>-->
                <!--    @elseif($item->status == '1')-->
                <!--    <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-success align-middle me-2">Running</span>-->
                <!--    @elseif($item->status == '3')-->
                <!--    <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-secondary align-middle me-2">Comleted</span>-->
                <!--    @elseif($item->status == '4')-->
                <!--    <span class="ri-checkbox-blank-circle-fill font-size-12 btn btn-danger align-middle me-2">Rejected</span>-->
                <!--    @endif-->
                <!-- </td>-->

                 <td>
                    @if($item->status == '0')
                       <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Pending</div>
                 
                    @elseif($item->status == '1')
                       <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-secondary align-middle me-2"></i>In Progress</div>

                    @elseif($item->status == '2')
                       <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Approved</div>
                    @endif
                 </td>

            <td>

<a href="{{ route('user.support.veiw', $item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-eye"></i> </a>


{{-- <a href="{{ route('user.support.delete', $item->id) }}" class="btn btn-danger sm" title="" id="">  <i class="fas fa-trash-alt"></i> </a> --}}

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

