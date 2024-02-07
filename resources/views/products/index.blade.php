@extends('layouts.app')

@section('content')

@php
    $resolutionCountsMonitor = $resolutionQuery->groupBy('resolution')->map->count();
    $displaySizeCountsMonitor = $displaySizeQuery->groupBy('display_size')->map->count();
    $panelTypeCountsMonitor = $panelTypeQuery->groupBy('panel_type')->map->count();
    $refreshRateCountsMonitor = $refreshRateQuery->groupBy('refresh_rate')->map->count();
    $responseTimeCountsMonitor = $responseTimeQuery->groupBy('response_time')->map->count();
    $processorCounts = $processorQuery->groupBy('processor')->map->count();
    $graphicsCardCounts = $graphicsCardQuery->groupBy('graphics_card')->map->count();
    $memoryCounts = $memoryQuery->groupBy('memory_ram')->map->count();
    $storageCounts = $storageQuery->groupBy('storage')->map->count();
    $osCounts = $osQuery->groupBy('operating_system')->map->count();
    $displayCounts = $displayQuery->groupBy('display')->map->count();
@endphp
<div class="container-fluid p-5">
<div class="row" >
<div class="col-2 checkbox-segment">
  <form>
    @csrf
    <div class="row-md-3">
      <div class="row-md-3">
        <div class="row-md-3 checkbox-wrapper">
            <label for="product">Product:</label>
            <div class="form-check custom-checkbox monitor-checkbox">
                <input class="form-check-input monitor-checkbox" type="checkbox" id="monitor" name="products[]" value="monitor">
                <label class="form-check-label" for="monitor">Monitor</label>
            </div>
            <div class="form-check custom-checkbox prebuild-checkbox">
                <input class="form-check-input prebuild-checkbox" type="checkbox" id="prebuilds" name="products[]" value="prebuilds">
                <label class="form-check-label" for="prebuilds">Prebuilds</label>
            </div>
            <div class="form-check custom-checkbox notebooks-checkbox">
                <input class="form-check-input notebooks-checkbox" type="checkbox" id="notebooks" name="products[]" value="notebooks">
                <label class="form-check-label" for="notebooks">Notebooks</label>
            </div>
        </div>
    </div>
    <div class="row-md-3 checkbox-wrapper monitor-rez hidden-checkbox">
        <label for="resolution">Resolution:</label>
        @foreach($resolutionCountsMonitor as $resolutionName => $count)
            <div class="form-check custom-checkbox">
                <input class="form-check-input resolution-checkbox" type="checkbox" id="{{ $resolutionName }}" name="categories[]" value="{{ $resolutionName }}">
                <label class="form-check-label" for="{{ $resolutionName }}">{{ $resolutionName }} ({{ $count }})</label>
            </div>
        @endforeach
    </div>
    <div class="row-md-3 checkbox-wrappe monitor-dis hidden-checkbox">
        <label for="display">Display Size:</label>
        @foreach($displaySizeCountsMonitor as $displayName => $count)
            <div class="form-check custom-checkbox">
                <input class="form-check-input display-checkbox" type="checkbox" id="{{ $displayName }}" name="categories[]" value="{{ $displayName }}">
                <label class="form-check-label" for="{{ $displayName }}">{{ $displayName }} ({{ $count }})</label>
            </div>
        @endforeach
    </div>
      <div class="row-md-3 checkbox-wrapper monitor-pan hidden-checkbox">
        <label for="panel">Panel Type:</label>
          @foreach($panelTypeCountsMonitor as $panelName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input panel-checkbox" type="checkbox" id="{{ $panelName }}" name="categories[]" value="{{ $panelName }}">
          <label class="form-check-label" for="{{ $panelName }}">{{ $panelName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper monitor-ref hidden-checkbox">
        <label for="refresh">Refresh Rate:</label>
          @foreach($refreshRateCountsMonitor as $refreshName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input refresh-checkbox" type="checkbox" id="{{ $refreshName }}" name="categories[]" value="{{ $refreshName }}">
          <label class="form-check-label" for="{{ $refreshName }}">{{ $refreshName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper monitor-res hidden-checkbox">
        <label for="response">Response Time:</label>
          @foreach($responseTimeCountsMonitor as $responseName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input response-checkbox" type="checkbox" id="{{ $responseName }}" name="categories[]" value="{{ $responseName }}">
          <label class="form-check-label" for="{{ $responseName }}">{{ $responseName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox prebuild-notebooks-pro">
        <label for="processor">Processor:</label>
          @foreach($processorCounts as $processorName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input processor-checkbox" type="checkbox" id="{{ $processorName }}" name="categories[]" value="{{ $processorName }}">
          <label class="form-check-label" for="{{ $processorName }}">{{ $processorName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox prebuild-notebooks-gra">
        <label for="graphics">Graphics Card:</label>
          @foreach($graphicsCardCounts as $graphicsName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input graphics-checkbox" type="checkbox" id="{{ $graphicsName }}" name="categories[]" value="{{ $graphicsName }}">
          <label class="form-check-label" for="{{ $graphicsName }}">{{ $graphicsName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox prebuild-notebooks-mem">
        <label for="memory">Memory:</label>
          @foreach($memoryCounts as $memoryName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input memory-checkbox" type="checkbox" id="{{ $memoryName }}" name="categories[]" value="{{ $memoryName }}">
          <label class="form-check-label" for="{{ $memoryName }}">{{ $memoryName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox notebooks-dis">
        <label for="display">Display:</label>
          @foreach($displayCounts as $displayName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input display-checkbox" type="checkbox" id="{{ $displayName }}" name="categories[]" value="{{ $displayName }}">
          <label class="form-check-label" for="{{ $displayName }}">{{ $displayName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox prebuild-notebooks-sto">
        <label for="storage">Storage:</label>
          @foreach($storageCounts as $storageName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input storage-checkbox" type="checkbox" id="{{ $storageName }}" name="categories[]" value="{{ $storageName }}">
          <label class="form-check-label" for="{{ $storageName }}">{{ $storageName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
      <div class="row-md-3 checkbox-wrapper hidden-checkbox prebuild-notebooks-os">
        <label for="os">Os:</label>
          @foreach($osCounts as $osName => $count)
      <div class="form-check custom-checkbox">
          <input class="form-check-input os-checkbox" type="checkbox" id="{{ $osName }}" name="categories[]" value="{{ $osName }}">
          <label class="form-check-label" for="{{ $osName }}">{{ $osName }} ({{ $count }})</label>
      </div>
  @endforeach
      </div>
    </div>
    <button type="button" id="resetButton" class="btn btn-primary mt-3">Reset Filters</button>
</form>
</div>

<div class="col-8">

  <div class="row pt-5" id="postsContainer">
    @foreach ($posts as $post)
        @php
            $tagsArray = is_array($post->tags) ? $post->tags : explode(',', $post->tags);
            $dataResolutionTags = implode(',', $tagsArray);
        @endphp

        <div class="col-2 resolution-post" data-resolution-tags="{{ $dataResolutionTags }}">
            <div>
                <a href="/products/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" alt="" class="w-100 rounded-image zoom-in-effect pb-5">
                    <span class="fw-bold text-dark pt-5">{{ $post->title }}</span>
                    <span class="fw-bold text-danger">{{ $post->price }} $</span>
                </a>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection