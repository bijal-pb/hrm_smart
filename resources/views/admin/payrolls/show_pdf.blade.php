@extends('admin.adminlayouts.adminlayout')

@section('head')

<style>

	@media print
	{
		.no-print, .no-print *
		{
			display: none !important;
		}
	}
</style>
@stop


@section('content')

<!-- BEGIN PAGE HEADER-->
<div id="panel-5" class="panel">
<div class="page-head">
     <div class="panel-hdr">
		<h1>
			@lang("pages.payroll.showTitle")
		</h1>
		</div>
	<div class="page-toolbar no-print">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height red-sunglo dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
				@lang("core.actions") <i class="fal fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="javascript:;" onclick="window.print()"><i class="fal fa-print"></i> @lang("core.print")</a>
				</li>
				<li>
					<a   href="{{ route('admin.payrolls.edit',$payroll->id)}}" ><i class="fal fa-edit"></i> @lang('core.edit')</a>
				</li>

				<li class="divider">
				</li>
				<li>
					<a   href="{{ route('admin.payrolls.downloadpdf',$payroll->id)}}" ><i class="fal fa-download"></i> @lang('core.btnDownload') PDF</a>
				</li>
			</ul>
		
		</div>
	</div>
</div>
</div>
			<div class="page-bar">
				<ul class="page-breadcrumb breadcrumb">
					<!-- <li>
						<a onclick="{{route('admin.dashboard.index')}}">@lang("core.dashboard")</a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<a class="no-print" href="{{ route('admin.payrolls.index') }}">@lang("pages.payroll.indexTitle")</a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<span class="active">@lang("pages.payroll.showTitle")</span>
					</li> -->
				</ul>


			</div>

<div class="portlet light">
	<div class="portlet-body">
@include('admin.payrolls.pdfview')
	</div>
</div>
@stop

@section('page_js')

@stop