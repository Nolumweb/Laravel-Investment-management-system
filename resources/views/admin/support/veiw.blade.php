@extends('admin.master')
@section('all')




<div class="page-content">
    <div class="container-fluid">


       

                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <div class="mb-0 flex-1">
                                <h5 class="font-size-14 my-1"> {{ (($data->firstname)) }} {{ (($data->lastname)) }}</h5>
                                <small class="text-muted">{{ (($data->email)) }}</small>
                           <p> <small class="text-primary">{{ __("This ticket was created on:") }}  {{ (($data->created_at)) }}</small></p>    
                            </div>
                        </div>
                         <h4 class="mt-0 font-size-16">{{ __("Subject:") }} {{ (($data->subject)) }}</h4>
                        <p>Dear Admin,</p>
                        <small class="text-primary">{{ __("Date of issue:") }}  {{ (($data->checkin_date)) }}</small> <br>
                        <small class="text-success">{{ __("Ticket Id:") }}  {{ (($data->ticket_no)) }}</small><br>
                        <small class="text-success">{{ __("Device Affected:") }}  {{ (($data->device)) }}</small>
                        <p> <b>{{ __("Short Note:") }}</b>  {{ (($data->short_msg)) }}</p>
                        <p>{{ (($data->message)) }}</p>
                        <p>Bye</p>
                        <hr/>

           

                  
            </div>
                    
                    
                    
                 

                      <a href="{{ route('admin.support.reply', $data->id) }}" class="btn btn-success waves-effect my-3"><i class="mdi mdi-reply"></i> Reply</a>
                        <a href=" {{ URL::previous() }}"  type="reset" class="btn btn-secondary waves-effect waves-effect my-3">Back </a>
                    </div>

                </div>
            </div>
            <!-- card -->
           

                </div>
                <!-- end Col-9 -->
            </div>
            <!-- end row -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



</div>
</div>

@endsection




