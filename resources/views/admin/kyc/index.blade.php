@extends('admin.master')
@section('all')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kyc Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kyc History</h4>
                        <!-- <table  id="datatable"  class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
                        <div class="table-responsive">
                    <table  id="datatable"  class="table table-bordered table-striped">
                        <thead class="table-light">
                                <tr>
                                    <th>Sn</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Date Of Created</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kycDocuments as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-center">{{ $item->user->email }}</td>
                                    <td class="text-center">{{ $item->document_type }}</td>
                                    <td class="text-center">{{ $item->created_at->format('D, j, Y, h:i A') }}</td>
                                    <td class="text-center">
                                        @if($item->status == 'pending')
                                        <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Pending</div>
                                        @elseif($item->status == 'verified')
                                        <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Approved</div>
                                        @elseif($item->status == 'failed')
                                        <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i>Rejected</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'pending')
                                        <a href="#" class="btn btn-info sm" title="Edit Data" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $item->id }}"><i class="fa fa-pencil-alt"></i></a>
                                        @else
                                        <a href="#" class="btn btn-info sm" title="View Data" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $item->id }}"><i class="fas fa-eye"></i></a>
                                        @endif
                                        <div class="modal fade" id="paymentModal{{ $item->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="paymentModalLabel{{ $item->id }}">Payment Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Display evidence of payment, amount, email, and feedback here -->
                                                        <img src="{{ asset("storage/$item->document_path") }}" alt="Evidence of Payment" class="img-fluid mb-3">
                                                        <p><strong>Document type	:</strong> {{ $item->document_type	 }}</p>
                                                        <p><strong>Email:</strong> {{ $item->user->email }}</p>
                                                    </div>
                                                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       
</div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>        </div>

        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
@endsection
