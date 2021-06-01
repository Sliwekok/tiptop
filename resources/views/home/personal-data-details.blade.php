@extends('layout')

@section('content')

    <div id="personal-data" class="container">
        <div class="row">
            <div class="col">
                <h1>Sposób przetwarzania danych osobowych</h1>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-lg-8">

                <h4>Jakie dane osobowe przetwarzam i skąd je pozyskuje</h4>

                <p>Przetwarzam Twoje dane osobowe, które podałeś mi wypełniając jeden z elektronicznych formularzy (“Formularz”), dostępnych w moim serwisie sarz.pl („Serwis”) lub które
                    zostały przekazane mi za Twoją zgodą przez podmioty zewnętrzne - np. Facebook (w szczególności Twoje dane uwierzytelniające stosowane w tych aplikacjach). Przy czym
                    ogólnie rzecz biorąc istnieją dwie kategorie danych, jakie zbieram: te które zbieram, abyś mógł korzystać z Serwisu oraz te, które podajesz mi dobrowolnie. Do pierwszej
                    kategorii będą należeć, w zależności od rodzaju Formularza oraz Twojej dalszej aktywności w Serwisie, takie dane osobowe, jak: Twoja nazwa, Twój adres e-mail, adres IP
                    lub inne identyfikatory internetowe oraz informacje gromadzone za pośrednictwem plików cookies, a także logi systemowe. Druga kategoria danych osobowych będzie obejmowała
                    takie dane osobowe, jak np. Twój numer telefonu. Dane podawane dobrowolnie możesz w każdej chwili usunąć.</p>

                <p>Jeśli przekazałeś mi dane osobowe osoby trzeciej, osoby fizycznej nieprowadzącej działalności gospodarczej lub Firmy - osoby fizycznej prowadzącej działalność gospodarczą,
                    zakładam, że uczyniłeś to za jej zgodą. Ze swej strony zobowiązuje się wypełnić wobec tej osoby obowiązek informacyjny o zasadach przetwarzania jej danych osobowych, a w
                    razie takiej konieczności - uzyskać od tej osoby zgodę na przetwarzanie jej danych.</p>

                <h4>Kto jest administratorem danych?</h4>

                <p>Administratorem danych osobowych jestem ja, czyli Marek Nijawski ul. Radosna 17, 62-020 Zalasewo.</p>

                <h4>Jak się skontaktować ze mną, administratorem danych?</h4>

                <p>We wszelkich sprawach związanych z przetwarzaniem Twoich danych osobowych możesz się ze mną skontaktować przesyłając wiadomość e-mail na adres: kontakt@sarz.pl.</p>

                <h4>Jaka jest podstawa prawna przetwarzania Twoich danych osobowych?</h4>

                <p>Przetwarzanie Twoich danych osobowych jest niezbędne do wykonania umowy łączącej Ciebie i Serwis sarz.pl (“Umowa”), do zawarcia której dochodzi w drodze akceptacji przez
                    Ciebie <a href="{{url('regulamin')}}">Regulaminu Serwisu</a> i dla wykonania której przetwarzanie przeze mnie Twoich danych osobowych, oznaczonych przeze mnie jako
                    obowiązkowe oraz Twojego adresu email, jest
                    niezbędne.</p>

                <p>Jeśli zdecydujesz się przekazać mi w Formularzu lub poprzez aplikację stron trzecich - np. Facebook więcej danych o Tobie, podstawą prawną przetwarzania przeze mnie takich
                    danych jest Twoja zgoda. Jeżeli jesteś osobą, która dodaje Ogłoszenie i podałeś mi szczególne kategorie danych osobowych, w szczególności dane dotyczące Twojego numeru
                    telefonu oraz Lokalizacji (dane adresowe), która może wskazywać na Twój adres zamieszkania, przetwarzam je na podstawie Twojej wyraźnej zgody i w celach wskazanych w
                    odpowiedniej klauzuli zgody umieszczonej na właściwym Formularzu. Przy czym masz prawo cofnięcia zgody w dowolnym momencie bez wpływu na zgodność z prawem przetwarzania,
                    którego dokonano na podstawie zgody przed jej cofnięciem.</p>

                <p>Jeśli wyrazisz chęć otrzymywania Powiadomień, podstawą prawną przetwarzania Twoich danych osobowych będą Twoja zgoda oraz prawnie uzasadnione interesy realizowane przez
                    sarz.pl.</p>

                <p>Nadto, jestem zobowiązany przetwarzać Twoje wybrane dane osobowe przez okres wskazany we właściwych przepisach.</p>

                <p>Podanie Twoich danych osobowych nie jest obowiązkowe, jednakże niepodanie danych oznaczonych w Formularzu jako obowiązkowe lub Twojego adresu e-mail może spowodować, że
                    Formularz nie zostanie wysłany i tym samym zawarcie i realizacja Umowy będą niemożliwe.</p>

                <p>Zob. treść art. 6 ust. 1 lit. a), b), c) oraz f) RODO.</p>

                <h4>Jaki jest cel, w jakim przetwarzamy Twoje dane osobowe?</h4>

                <p>Twoje dane osobowe przetwarzam przede wszystkim w celu zawarcia z Tobą umowy i jej wykonaniu. W szczególności bez przetwarzania Twoich danych nie mógłbym stworzyć dla
                    Ciebie Konta w Serwisie oraz umożliwić Ci dodawania Ogłoszeń, jak również nie mógłbym umożliwić Tobie dostępu do szeregu świadczonych przeze mnie w ramach Serwisu usług.
                    Twoje dane osobowe będę wykorzystywać także w celu kontaktów związanych z realizacją Umowy.</p>

                <p>Jeśli wyrazisz zgodę na otrzymywanie Powiadomień, Twój adres e-mail będzie wykorzystywany do przesyłania wiadomości e-mail zawierających informacje o nowych Ogłoszeniach w
                    okolicy Twojego Ogłoszenia - jeżeli takowa opcja zostanie wybrana podczas dodawania Ogłoszenia.</p>

                <p>Nadto możemy przetwarzać Twoje dane osobowe celem dokonywania pomiarów i analiz statystycznych celem lepszego dopasowywania Serwisu do Twoich potrzeb.</p>

                <p>Dane przekazane mi poprzez Formularz lub udostępnione za Twoją zgodą przez Facebook mogą być przeze mnie przetwarzane w celu archiwizacji informacji lub dokumentów
                    potwierdzających wykonanie przez nas obowiązków wynikających z Umowy oraz w celu dochodzenia ewentualnych roszczeń lub obrony przed roszczeniami skierowanymi przeciwko
                    mnie. Przetwarzając Twoje dane osobowe w tym celu będę kierować się, m.in. zasadą minimalizacji, tj. by przetwarzane dane były stosowne oraz ograniczone do tego, co jest
                    niezbędne dla osiągnięcia wspomnianego celu.</p>

                <h4>Komu udostępniamy Twoje dane osobowe?</h4>

                <p>Twoje dane osobowe są przechowywane na serwerach dzierżawionych przeze mnie od zaufanego partnera. Twoje dane osobowe są przetwarzane przy pomocy innych podmiotów,
                    zwłaszcza zaufanych dostawców systemów, sprzętu i usług IT, które to podmioty świadczą na moje zlecenie usługi związane z przetwarzaniem danych osobowych, np. usługi
                    analizy i przygotowania statystyk Serwisu.</p>

                <p>Ponieważ część rozwiązań informatycznych, z jakich korzystam jest oferowana przez podmioty spoza Europejskiego Obszaru Gospodarczego (EOG), głównie przez firmy z USA, w
                    określonych przypadkach przekazuje Twoje dane osobowe poza EOG zapewniając jednak odpowiedni poziom ich ochrony. W szczególności, w przypadku przekazywania Twoich danych
                    do USA, współpracuje z podmiotami, które uczestniczą w programie “Tarcza Prywatności UE-USA” (Privacy Shield). Tu możesz sprawdzić, czy dany podmiot z USA uczestniczy w
                    tym programie: <a href="https://www.privacyshield.gov/list" target="_blank">https://www.privacyshield.gov/list</a>.</p>

                <p>Mogę też zostać zobowiązany do przekazania Twoich danych właściwym organom lub osobom trzecim, jeśli ich żądanie udzielenia takich informacji będzie miało swoją podstawę
                    prawną.</p>

                <h4>Jak długo przetwarzam Twoje dane?</h4>

                <p>Twoje dane, jeżeli zostały podane w Formularzu lub przekazane mi za Twoją zgodą przez Facebook, przetwarzane są tak długo, jak długo wiąże mnie z Tobą umowa. Po
                    rozwiązaniu umowy przechowuje Twoje dane przez okres, w jakim Ty mógłbyś dochodzić ode mnie roszczeń związanych z niewykonaniem lub nienależytym wykonaniem przeze mnie
                    umowy oraz przez jaki mógłbym dochodzić takich roszczeń od Ciebie.</p>

                <p>Jeżeli przetwarzam twój adres e-mail w związku z przesyłaniem Powiadomień lub inne Twoje dane za Twoją zgodą, Twoje dane przetwarzam dopóki nie cofniesz udzielonej mi
                    zgody albo nie zakażesz mi ich przetwarzania. Zgodę możesz cofnąć w dowolnym momencie, przy czym pozostaje to bez wpływu na zgodność z prawem przetwarzania, którego
                    dokonano na podstawie zgody przed jej cofnięciem.</p>

                <h4>Jakie masz prawa?</h4>

                <p>Przysługują Tobie następujące prawa związane z przetwarzaniem Twoich danych osobowych:</p>

                <ul style="margin-bottom: 20px;">
                    <li>prawo do potwierdzenia przetwarzania Twoich danych osobowych,</li>
                    <li>prawo wycofania zgody na przetwarzanie danych,</li>
                    <li>prawo dostępu do Twoich danych osobowych,</li>
                    <li>prawo żądania sprostowania Twoich danych osobowych,</li>
                    <li>prawo żądania usunięcia Twoich danych osobowych (“prawo do bycia zapomnianym”),</li>
                    <li>prawo żądania ograniczenia przetwarzania Twoich danych osobowych,</li>
                    <li>prawo wyrażenia sprzeciwu wobec przetwarzania Twoich danych ze względu na Twoją szczególną sytuację – w przypadkach, kiedy przetwarzamy Twoje dane na podstawie
                        naszego prawnie uzasadnionego interesu,
                    </li>
                    <li>prawo do przenoszenia Twoich danych osobowych, tj. prawo otrzymania od nas Twoich danych osobowych, w ustrukturyzowanym, powszechnie używanym formacie informatycznym
                        nadającym się do odczytu maszynowego. Możesz przesłać te dane innemu administratorowi danych lub zażądać, abyśmy przesłali Twoje dane do innego administratora.
                        Jednakże zrobimy to tylko jeśli takie przesłanie jest technicznie możliwe. Prawo do przenoszenia danych osobowych przysługuje Ci tylko co do tych danych, które
                        przetwarzamy na podstawie umowy z Tobą lub na podstawie Twojej zgody.
                    </li>
                </ul>

                <p>Aby skorzystać z powyższych praw, skontaktuj się z nami.</p>

                <h4>Poniżej omawiamy szerzej wybrane kategorie Twoich uprawnień:</h4>

                <h4>Prawo do potwierdzenia przetwarzania Twoich danych osobowych</h4>

                <p>Masz prawo uzyskać ode mnie potwierdzenie, czy przetwarzane są Twoje dane osobowe, a jeżeli ma to miejsce, jesteś uprawniony do uzyskania dostępu do danych oraz uzyskania
                    informacji, dotyczących przetwarzania Twoich danych.</p>

                <h4>Prawo żądania sprostowania Twoich danych osobowych</h4>

                <p>Możesz zażądać ode mnie niezwłocznego sprostowania dotyczących Ciebie danych osobowych, jeżeli uważasz, że są nieprawidłowe lub nieaktualne. Możesz też zwrócić się do mnie
                    o uzupełnienie, jeżeli uważasz, że Twoje dane są, z uwagi na cel w jakim przetwarzamy dane, niekompletne.</p>

                <h4>Prawo żądania usunięcia Twoich danych osobowych (“prawo do bycia zapomnianym”)</h4>

                <p>Masz “prawo do bycia zapomnianym”. Oznacza to, że możesz ode mnie żądać usunięcia Twoich danych osobowych, a ja niezwłocznie dane usunę, jeżeli, m.in.:</p>

                <ul style="margin-bottom: 20px;">
                    <li>dane osobowe nie są już niezbędne do celów, w jakich mam prawo je przetwarzać,</li>
                    <li>jeżeli przetwarzam dane na podstawie Twojej zgody, a Ty cofnąłeś udzieloną zgodę,</li>
                    <li>zdarzyło się, pomimo dokładania przeze mnie wszelkich starań by należycie chronić Twoje dane i przetwarzać je w zgodzie z obowiązującymi przepisami, że są one
                        przetwarzane niezgodnie z prawem,
                    </li>
                    <li>przymus usunięcia danych wynika z celu wywiązania się przeze mnie z obowiązku prawnego przewidzianego w prawie Unii Europejskiej lub prawie Rzeczypospolitej
                        Polskiej.
                    </li>
                </ul>

                <p>Jeżeli chcesz zgłosić żądanie usunięcia Twoich danych osobowych, wyślij do nas wiadomość z adresu e-mail przypisanego do Twojego konta na adres: <a
                            href="mailto:kontakt@sarz.pl">kontakt@sarz.pl</a>.</p>

                <h4>Prawo żądania ograniczenia przetwarzania Twoich danych osobowych</h4>

                <p>Możesz żądać ode mnie ograniczenia przetwarzania Twoich danych, jeżeli:</p>

                <ul style="margin-bottom: 20px;">
                    <li>kwestionujesz prawidłowość danych osobowych – na okres pozwalający mi sprawdzić prawidłowość tych danych,</li>
                    <li>przetwarzanie Twoich danych jest w Twojej ocenie niezgodne z prawem ale sprzeciwiasz się ich usunięciu, żądając w zamian ograniczenia ich wykorzystywania,</li>
                    <li>nie potrzebuje już danych osobowych do celów przetwarzania, ale są one potrzebne Tobie do ustalenia, dochodzenia lub obrony roszczeń,</li>
                    <li>wniosłeś sprzeciw wobec przetwarzania przeze mnie danych - do czasu stwierdzenia, czy prawnie uzasadnione podstawy po mojej stronie są nadrzędne wobec podstaw Twojego
                        sprzeciwu.
                    </li>
                </ul>

                <h4>Prawo wniesienia skargi do organu</h4>

                <p>Masz prawo do wniesienia skargi na moje działania lub zaniechania do organu nadzorczego jakim jest dla nas od dnia 25 maja 2018 r. Prezes Urzędu Ochrony Danych
                    Osobowych.</p>

                <h4>Profilowanie i zautomatyzowane podejmowanie decyzji</h4>

                <p>Na podstawie danych o Twojej aktywności w Serwisie (w tym m.in. plików cookies oraz innych podobnych identyfikatorów internetowych, a także logów systemowych) tworzę na
                    własne potrzeby Twój profil. Dzięki temu mogę dostosowywać do Twoich preferencji treść Powiadomień, które otrzymujesz, gdy wyraziłeś na to swą zgodę.</p>

                <p>Wyjaśniam, że pliki cookies są to małe pliki tekstowe instalowane na Twoim urządzeniu (np. komputerze, smartfonie, tablecie), gdy przeglądasz mój serwis sarz.pl
                    niezależnie od tego, czy jesteś zalogowany, czy nie. Pliki cookies zawierają w szczególności nazwę domeny serwisu internetowego, z którego pochodzą, czas ich
                    przechowywania na Twoim urządzeniu oraz unikalny numer.</p>

                <p>W każdym czasie możesz dokonać zmiany ustawień dotyczących plików cookies. Ustawienia te mogą zostać zmienione w szczególności w taki sposób, aby blokować automatyczną
                    obsługę plików cookies w ustawieniach Twojej przeglądarki internetowej bądź informować o ich każdorazowym zamieszczeniu w Twoim urządzeniu. Szczegółowe informacje o
                    możliwości i sposobach obsługi plików cookies dostępne są w ustawieniach oprogramowania (przeglądarki internetowej). Proszę byś miał na uwadze, że blokowanie plików
                    cookies może spowodować trudności w korzystaniu z mojego Serwisu.</p>

                <p>Korzystam z narzędzia Google Analytics oferowanego przez Google, by obserwować Twoją aktywność w Serwisie, w oparciu, m.in. o mechanizm plików cookies. Te działania
                    podejmuje w celach analitycznych i statystycznych po to, by stale ulepszać Serwis.</p>

                <p>Masz prawo w każdej chwili wnieść bezpłatnie sprzeciw wobec profilowania, o jakim mowa powyżej. Poinformuj mnie o tym niezwłocznie w razie potrzeby.</p>

                <p>Jednakże w oparciu o Twoje dane osobowe nie będę podejmował wobec Ciebie żadnych zautomatyzowanych decyzji.</p>

            </div>
        </div>
    </div>

@endsection