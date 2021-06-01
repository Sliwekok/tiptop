<!-- Modal -->
<div class="modal fade" id="changeAnimalPhoto">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{url('ogloszenie/zmien-zdjecie')}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zmień zdjęcie</h5>
                </div>
                <div class="modal-body text-center">
                    {{csrf_field()}}
                    <div>
                        <input type="file" accept="image/jpeg,image/png,image/gif" name="photo" class="form-control-file" required/>
                        <input type="hidden" name="idAnimal" value=""/>
                        <input type="hidden" name="idPhoto" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Zatwierdź</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link">Anuluj</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#changeAnimalPhoto').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget),
                    idAnimal = button.parent().data('animal-id'),
                    idPhoto = button.parent().data('photo-id'),
                    modal = $(this);
                modal.find('input[name="idAnimal"]').val(idAnimal);
                modal.find('input[name="idPhoto"]').val(idPhoto);
                modal.find('input[name="photo"]').val("");
            })
        });
    </script>
@endpush