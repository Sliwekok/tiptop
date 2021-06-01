@extends('layout')

@section('content')

    <div id="personal-data" class="container">
        <div class="row">
            <div class="col">
                <h1>Przetwarzanie danych osobowych</h1>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="col-lg-8">

                <p>W dniu 25 maja 2018 roku weszły w życie przepisy Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych
                    w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE („RODO”).</p>

                <p>W związku z powyższym Serwis sarz.pl realizuje niniejszym swój obowiązek informacyjny wobec Ciebie - czyli osoby, której dane osobowe Serwis sarz.pl przetwarza. Proszę
                    zapoznaj się z poniższą informacją. Określa ona w sposób możliwie przystępny zasady i cele przetwarzania przez Serwis sarz.pl Twoich danych osobowych oraz wyjaśnia, w
                    jaki sposób przestrzegam Twoich praw i w jaki sposób możesz ich dochodzić.</p>

                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" class="text-center">Informacje podstawowe dotyczące przetwarzania Twoich danych osobowych</td>
                    </tr>
                    <tr>
                        <td>Administrator danych</td>
                        <td>Marek Nijawski ul. Radosna 17, 62-020 Zalasewo, adres e-mail do kontaktu: dane@sarz.pl.</td>
                    </tr>
                    <tr>
                        <td>Cele przetwarzania</td>
                        <td>
                            <ul>
                                <li>w celu wykonania umowy, którą zawierasz z nami poprzez akceptację <a href="{{url('regulamin')}}">Regulaminu Serwisu</a>;</li>
                                <li>w celu kontaktu z Tobą, w tym przekazywania Tobie materiałów informacyjnych, zwłaszcza o Ogłoszeniach, w tym materiałów spersonalizowanych;</li>
                                <li>w celu kontaktu z Tobą, gdy będziesz potrzebować pomocy, w sprawie dodania Ogłoszenia w Serwisie;</li>
                                <li>w celach analitycznych i statystycznych, by stale poprawiać jakość usług świadczonych w ramach Serwisu i lepiej dopasowywać go do Twoich potrzeb.</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Podstawy prawne przetwarzania</td>
                        <td>
                            <ul>
                                <li>przetwarzanie Twoich danych jest niezbędne do wykonania przez nas zawartej z Tobą umowy;</li>
                                <li>Twoja zgoda, gdy dane podałeś nam dobrowolnie;</li>
                                <li>nasz uzasadniony interes, np. przesyłanie materiałów informacyjnych Serwisu sarz.pl, w tym spersonalizowanych;</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Odbiorcy danych</td>
                        <td>
                            <ul>
                                <li>Podmioty przetwarzające dane w imieniu Serwisu sarz.pl, zwłaszcza nasi dostawcy sprzętu, systemów i usług IT,</li>
                                <li>Odbiorcy o jakich mowa w <a href="{{url('regulamin')}}">Regulaminie Serwisu</a>.</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Prawa związane z przetwarzaniem danych</td>
                        <td>
                            <ul>
                                <li>prawo wycofania zgody na przetwarzanie danych;</li>
                                <li>prawo dostępu do danych osobowych oraz prawo żądania ich sprostowania, ich usunięcia lub ograniczenia ich przetwarzania;</li>
                                <li>inne prawa określone w <a href="{{url('/przetwarzanie-danych-osobowych')}}">informacji szczegółowej</a>;</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Szczegółowe informacje</td>
                        <td><a href="{{url('/przetwarzanie-danych-osobowych')}}">Tutaj znajdziesz informacje szczegółowe</a> na temat zasad przetwarzania Twoich danych osobowych.</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

@endsection