@extends('layouts.adminindex')

@section('content')
    
    {{-- Start Page Content Area  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('days.store') }}" method="POST">
                    
                    {{ csrf_field() }}
                    
                    <div class="row align-items-end">
                        <div class="col-md-6 form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Day" />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                @foreach($statuses as $status)
                                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                        </div>
                    </div>
                    
                </form>
            </div>

            <hr class="my-3"/>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                    </div>
                    <div class="col-md-10">
                        <form action="" method="">
                            <div class="row justify-content-end">

                                <div class="col-md-2 col-sm-6 mb-2 form-group">
                                    <div class="input-group">
                                        <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search...." />
                                        <button type="submit" id="search-btn" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                                    </div>
                                    
                                </div>
        
                            
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <table id="mytable" class="table table-sm table-hover border">
                    <thead>
                       <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                            </th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Staus</th>
                            <th>By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $idx=>$day)
                            <tr>
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$day->id}}" />
                                </td>
                                <td>{{ ++$idx }}</td>
                                <td>{{ $day->name }}</td>
                                <td>{{ $day->status->name }}</td>
                                <!-- <td>{{ $status->user['name'] }}</td> -->
                                <td>{{ $day['user']['name'] }}</td>
                                <td>{{ $day->created_at->format("d M Y") }}</td>
                                <td>{{ $day->updated_at->format("d M Y ") }}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx="{{$idx}}"><i class="fas fa-trash-alt"></i></a>

                                    <form id="formdelete-{{$idx}}" action="{{route('days.destroy',$day->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')  

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- end Page Content Area  --}}

@endsection

@section('css')
@endsection


@section('scripts')

    <script type="text/javascript">

        // Single Delete 
            $(document).ready(function(){
                $('.delete-btn').click(function(){
                    const getidx = $(this).data('idx');
                    // console.log(getidx);

                    if(confirm(`Are you sure! you want to delete ${getidx}`)){
                        $('#formdelete-'+getidx).submit();
                        return true;
                    }else{
                        return false;
                    }
                });
            });

        // Single Delete

        // Bulk Delete 
        $('#selectalls').click(function(){
            $('.singlechecks').prop('checked',$(this).prop('checked'));
        })
        // Bulk Delete 
    </script>


@endsection
        