<!-- Modal -->
<div class="modal fade" id="removeAnimal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('ogloszenie/usun')}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Usuń ogłoszenie</h5>
                </div>
                <div class="modal-body text-center">
                    {{csrf_field()}}
                    Czy, aby na pewno chcesz usunąć wybrane ogłoszenie?
                    <input type="hidden" name="id" value="" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Tak, usuń</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link">Anuluj</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#removeAnimal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget),
                    idAnimal = button.parent().data('animal-id'),
                    modal = $(this);
                modal.find('input[name="id"]').val(idAnimal);
            })
        });
    </script>
@endpush