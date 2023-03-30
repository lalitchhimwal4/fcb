@section('title','Members')
@extends('layouts.admin.main')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <h1 class="m-0">Primary Insured Members</h1>
    </div>

    <section class="content">
        <div class="">
            @include('admin.error_message')
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach

            <form class="row email-temp-row" method="post" action="{{route('admin.members.index')}}">
                @csrf
                <div class="col-md-1"><label class="control-label">Search</label></div>
                <div class="col-md-3"><input type="text" name="search" class="form-control" value="{{$search}}" required></div>
                <div class="col-md-2"><button class="btn btn-primary">Submit</button></div>
            </form>

            @if(count($members))
            <div class="card-body table-responsive">
                <table id="customboxeslist" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Member #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Status</th>
                            <th>Family Members</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{$member->member_number}}</td>
                            <td>{{$member->first_name . ' ' . $member->last_name}}</td>
                            <td>{{$member->email}}</td>
                            <td>{{($account_statuses != 0 && isset($account_statuses[$member->account_status])) ? $account_statuses[$member->account_status] : $member->account_status}}</td>
                            <td>
                                <ul>
                                    @foreach($member->familyMembers() as $family_member)
                                    <li>{{$family_member->first_name . ' ' . $family_member->last_name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><a href="{{route('admin.member.edit', ['id' => $member->id])}}" class="btn btn-danger">More Info</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <div class="navigation-links">{{ $members->links() }}</div>
                <div class="navigation-links">
                    <p>Showing page {{ $members->currentPage() }} of {{ ceil($members->total() / $members->perPage()) }}</p>
                </div>
            </div>
            @else
            <div>No primary members to be displayed</div>
            @endif
        </div>
    </section>
</div>
@endsection