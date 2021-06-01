<!-- Modal -->
<div class="modal fade" id="registerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zarejestruj się</h5>
            </div>
            <div class="modal-body text-center">
                <form method="post" autocomplete="off" action="{{url('create-user')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" autocomplete="off" name="name" placeholder="Nazwa użytkownika" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" autocomplete="new-email" name="email" placeholder="Adres email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" autocomplete="new-password" name="password" placeholder="Hasło" class="form-control" required/>
                    </div>
                    <div class="form-group text-left approval">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" required class="custom-control-input" name="terms" id="term">
                            <label class="custom-control-label" for="term">Akceptuję <a title="Kliknij, aby wyświetlić regulamin" href="{{url('/regulamin')}}" target="_blank">regulamin</a> oraz <a title="Kliknij, aby wyświetlić politykę prywatności" href="{{url('/polityka-prywatnosci')}}" target="_blank">politykę prywatności</a> sarz.pl.*</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" required class="custom-control-input" name="personalData" id="personalData">
                            <label class="custom-control-label" for="personalData">Akceptuję <a href="{{url('/dane-osobowe')}}" target="_blank">zasady przetwarzania moich danych osobowych</a> przez Serwis sarz.pl.*</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="messagesNotification" id="messagesNotification">
                            <label class="custom-control-label" for="messagesNotification">Wyrażam zgodę na otrzymywanie powiadomień e-mail.</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning w-50">Zarejestruj się</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Masz już konto? <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Zaloguj się</a></p>
            </div>
        </div>
    </div>
</div>