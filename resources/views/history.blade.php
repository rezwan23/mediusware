@extends('layouts.app')

@section('footer1')
    <script src="/date.js"></script>
    <script>
        $('#pwd1').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

@endsection

@section('head1')
    <link rel="stylesheet" href="/date.css">
@endsection
@section('content')

    <div class="container-fluid app-body app-home">
        <h2></h2>
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Recent Post Sent to buffer</h1></div>
            <div class="panel-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="email"><i class="fa fa-search"></i></label>
                        <input type="text" value="{{request()->get('search')??''}}" class="form-control" id="email" name="search">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Date:</label>
                        <input type="text" value="{{request()->get('date')??''}}" class="form-control" autocomplete="off" id="pwd1" name="date">
                    </div>
                    <div class="form-group">
                        <label for="pwd1">Group:</label>
                        <select class="form-control" name="group_type" id="pwd1">
                            <option value="*">All Group</option>
                            @foreach($groups as $group)
                                <option @if(request()->get('group_type') == $group->id) selected @endif value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <table class="table table-bordered social-accounts">
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Group Type</th>
                        <th>Account Name</th>
                        <th>Post Text</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postings as $posting)
                        <tr>
                            <td>{{$posting->groupInfo?$posting->groupInfo->name:''}}</td>
                            <td>{{ucfirst($posting->groupInfo?$posting->groupInfo->type:'')}}</td>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <span class="fa fa-facebook"></span>
                                            <img width="50" class="media-object img-circle" src="{{$posting->accountInfo->avatar}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{\Illuminate\Support\Str::words($posting->post_text, 5, '...')}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($posting->created_at)->format('d F, Y, h:s a')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{$postings->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection