<!-- Modal -->
<div class="modal fade" id="finishAnimal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{url('ogloszenie/zakoncz')}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zakończ ogłoszenie</h5>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Status zakończenia</label>
                        <select class="form-control" name="status" required>
                            <option value="">Wybierz</option>
                            <option value="found-home">Odnaleziono właściciela</option>
                            <option value="found-animal">Odnaleziono zwierzę</option>
                            <option value="shelter">Trafiło do schroniska</option>
                            <option value="dead">Znaleziono martwe</option>
                            <option value="other">Inne</option>
                        </select>
                    </div>
                    <div>
                        <label>Szczegóły</label>
                        <input type="text" maxlength="255" placeholder="Napisz kilka słów więcej..." name="reason" class="form-control"/>
                        <input type="hidden" name="idAnimal" value=""/>
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
            $('#finishAnimal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget),
                    idAnimal = button.parent().data('animal-id'),
                    modal = $(this);
                modal.find('input[name="idAnimal"]').val(idAnimal);
                setTimeout(function () {
                    modal.find('input[name="reason"]').val('');
                    modal.find('select[name="status"]').val('').focus();
                }, 250);
            })
        });
    </script>
@endpush