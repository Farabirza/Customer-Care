@extends('layouts.master')

@push('css-styles')
<style>
@media (max-width: 1199px) {
}
</style>
@endpush

@section('content')

<h1>Hello World</h1>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('#link-dashboard').addClass('active');
});
</script>
@endpush