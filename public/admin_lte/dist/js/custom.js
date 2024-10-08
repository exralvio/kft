/**
 * Fazrin
 * ------------------
 * Common script for admin common features.
 */
function deleteList(url, id, itemToDelete, e){
    $('#modal-content').empty();
    $('#modal-content').append('Are you sure you want to delete this record ?'); //'+itemToDelete+'
    $('#confirm-modal').modal('show');
    $('#del-btn-modal').on('click', function(){
        $.ajax({
            type: "DELETE",
            url: url+id,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function( msg ) {
            // $('#list-'+id).remove();
            $(e).closest('tr').remove();
            $('#confirm-modal').modal('hide');
        });
    })
}