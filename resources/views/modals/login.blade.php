<!-- Modal -->
<div class="modal fade" id="loginModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zaloguj się</h5>
            </div>
            <div class="modal-body text-center">
                <form method="post" autocomplete="off" action="{{url('login')}}">
                    {{csrf_field()}}
                    <div>
                        <a href="{{url('auth/facebook')}}" class="btn btn-lg btn-facebook w-100"><i class="fab fa-facebook-f mr-2"></i> Zaloguj przez Facebook</a>
                    </div>
                    <div><h4 class="or">LUB</h4></div>
                    <div class="form-group">
                        <input autocomplete="off" type="email" name="email" placeholder="Adres email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input autocomplete="new-password" type="password" name="password" placeholder="Hasło" class="form-control" required/>
                    </div>
                    <input type="hidden" name="ref" value="/"/>
                    <div>
                        <button type="submit" class="btn btn-warning w-50">Zaloguj</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Nie masz konta? <a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Zarejestruj się</a></p>
                <p><a href="#" data-toggle="modal" data-target="#remindPasswordModal" data-dismiss="modal">Nie pamiętasz hasła?</a></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#loginModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget),
                    ref = button.data('ref'),
                    modal = $(this),
                    fbBtnHref = modal.find('.btn-facebook').attr('href');
                if (ref) {
                    modal.find('input[name="ref"]').val(ref);
                    modal.find('.btn-facebook').attr('href', fbBtnHref + '?ref=' + baseUrl + '/' + ref);
                }
            })
        });
    </script>
@endpush