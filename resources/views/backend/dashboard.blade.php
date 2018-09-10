@extends('layouts.backend')

@section('content')
<div class="my-url">
  <div class="card">
    <div class="card-body">
      <div class="row">
      <div class="col-sm-6">
        <h4 class="card-title mb-3">
          {{ __('My URLs') }}
        </h4>
      </div><!--col-->
      </div><!--row-->

      <table class="table table-responsive-sm table-striped">
        <thead>
          <tr>
            <th scope="col">@lang('Short URL')</th>
            <th scope="col">@lang('Long URL')</th>
            <th scope="col">@lang('View')</th>
            <th scope="col">@lang('Date')</th>
            <th scope="col">@lang('Actions')</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($myurls as $myurl)
          <tr>
            <td><a href="{{url('/'.$myurl->short_url)}}" target="_blank">{{$myurl->short_url}}</a></td>
            <td><a href="{{$myurl->long_url}}" target="_blank">{{$myurl->long_url_mod}}</a></td>
            <td>{{$myurl->views}}</td>
            <td><span title="{{$myurl->created_at}}">{{$myurl->created_at->diffForHumans()}}</span></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a role="button" class="btn btn-primary" href="{{ route('short_url.statics', $myurl->short_url) }}" target="_blank" title="@lang('Details')"><i class="fa fa-eye"></i></a>
                <a role="button" class="btn btn-danger" href="{{ route('url.delete', $myurl->id) }}" title="@lang('Delete')"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>
          @empty
            Data not found
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
