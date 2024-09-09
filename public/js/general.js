$('input').on('', function (e) { 
    e.preventDefault();
    $(this).removeClass('bg-danger-subtle', 'border-danger');
});