@extends('admin.master')
@section('all')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Wallet Data</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Wallet Data </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>Sn</th>
                                    <th>name</th>
                                    <th>address</th>
                                    <th>Maximum Amount</th>
                                    <th>Minimum Amount</th>
                                    <th>Date Created</th>
                                    <th>Actions</th> <!-- Added column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($wallets as $key => $item)
    <tr>
        <td>{{ $key+1 }}</td>
        <td class="text-center">{{ $item->name }}</td>
        <td class="text-center">{{ $item->address }}</td>
        <td class="text-center">{{ $item->max_amount }}</td>
        <td class="text-center">{{ $item->min_amount }}</td>
        <td class="text-center">{{ $item->created_at->format('D, j, Y') }}</td>
       
        <td>

  
        <a href="{{ route('wallets.edit', $item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-eye"></i> </a>

    <form method="POST" action="{{ route('wallets.destroy', ['id' => $item->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger sm" title="" id="">  <i class="fas fa-trash-alt"></i></button>
    </form>
        
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



        </div>
    </div>
</div>




@endsection
