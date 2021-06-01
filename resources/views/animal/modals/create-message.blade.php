<!-- Modal -->
<div class="modal fade" id="createMessage">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{url('konto/create-message')}}">
                <div class="modal-header">
                    <h5 class="modal-title">Nowa wiadomość</h5>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div>
                        <label>Wpisz treść wiadomości</label>
                        <textarea name="message" class="form-control" rows="5" required placeholder="Wpisz treść wiadomości"></textarea>
                        <input type="hidden" name="idAnimal" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Wyślij wiadomość</button>
                    <button type="button" data-dismiss="modal" class="btn btn-link">Anuluj</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#createMessage').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget),
                    idAnimal = button.data('animal-id'),
                    modal = $(this);
                modal.find('input[name="idAnimal"]').val(idAnimal);
                setTimeout(function () {
                    modal.find('textarea[name="message"]').val('').focus();
                }, 250);
            })
        });
    </script>
@endpush