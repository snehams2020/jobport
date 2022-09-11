@extends('layouts.app')

@section('content')
       
         <div class="container">
               <h2>Job Listing</h2>

    <table class="table" id="table">
    <div align="right"><a href="{{route('create-job')}}" class="btn btn-primary">Create Job</a></div>
<br/>
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center"> Name</th>
            <th class="text-center"> Email</th>
            <th class="text-center">Company</th>
            <th class="text-center">Location</th>
            <th class="text-center">JobType</th>
            <th class="text-center">Emirates</th>
            <th class="text-center">Status </th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    
</table>
<script>
     $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ url('index') }}",
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'company_name', name: 'company_name' },
                        { data: 'location', name: 'location' },
                        { data: 'job_type', name: 'job_type' },
                        { data: 'emirates', name: 'emirates' },
                        { data: 'status', name: 'status' },
                        {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },


                     ]
            });
         });
//   $(document).ready(function() {
//     $('#table').DataTable();
// } );
 </script>

@endsection
