@if (\Session::has('error'))
<script>
toast("{{ \Session::get('error') }}", 'error');
</script>
@elseif (\Session::has('success'))
<script>
toast("{{ \Session::get('success') }}", 'success');
</script>
@elseif (\Session::has('warning'))
<script>
toast("{{ \Session::get('warning') }}", 'warning');
</script>
@elseif (\Session::has('status'))
<script>
toast("{{ \Session::get('status') }}", 'success');
</script>
@endif
@if(isset($errors) && $errors->any())
<script>
handleAPIErrors({
   data : {!! $errors !!},
   message : 'Opps, there are some problems.'
})
</script>
@endif