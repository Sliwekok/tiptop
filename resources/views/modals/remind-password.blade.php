<!-- Modal -->
<div class="modal fade" id="remindPasswordModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resetuj hasło</h5>
            </div>
            <div class="modal-body text-center">
                <form method="post" action="{{ url('resetuj-haslo') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Adres email" class="form-control" required/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning w-75">Przypomnij hasło</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Nie masz konta? <a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Zarejestruj się</a></p>
            </div>
        </div>
    </div>
</div>