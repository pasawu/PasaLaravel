@yield('js')
<script type='text/javascript'>
    @if (count($errors) > 0)
    var errors = '';
    @foreach ($errors->all() as $error)
        errors += '{{ $error }} \n';
    @endforeach
    alert(errors);
    @endif
</script>
@yield('script')