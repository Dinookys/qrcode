<x-app>
    <x-slot name="title">QRCode</x-slot>

    <h1 class="text-2xl font-semibold border-b-2 border-black text-right">QRCode</h1>

    @include('form-get')

    <h3 class="text-1xl mt-4">Copie a URL abaixo ou click em Gerar QR-Code</h3>
    <div class="p-2 bg-black text-gray-400 rounded overflow-x-auto">
        {{ route('api-qrcode-create') }}<span class="query text-green-600 word-wrap"></span>
    </div>

    @include('form-post')

    <h3 class="text-1xl mt-4">Parâmetros da URL</h3>
    <div>
        <table class="table-fixed border-collapse border-spacing-2 p-1 border border-slate-500 w-full">
            <thead>
                <tr>
                    <th class="p-1 border border-slate-600 w-48">Parâmetro</th>
                    <th class="p-1 border border-slate-600 w-48">Tipo</th>
                    <th class="p-1 border border-slate-600 w-48">Obrigátorio</th>
                    <th class="p-1 border border-slate-600">Desc</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-1 border border-slate-600"><code>name</code></td>
                    <td class="p-1 border border-slate-600">string</td>
                    <td class="p-1 border border-slate-600"><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600">Nome para o qrcode, o sistema irá redirecionar para a url
                        apos gerar.</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600"><code>content</code></td>
                    <td class="p-1 border border-slate-600">string</td>
                    <td class="p-1 border border-slate-600">Sim</td>
                    <td class="p-1 border border-slate-600">Contéudo que será visualizado ao ler o QRcode</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600"><code>logo</code></td>
                    <td class="p-1 border border-slate-600">string | file</td>
                    <td class="p-1 border border-slate-600"><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600">
                        <div class="my-4">
                            <span class="text-xs border p-1 text-blue-500 border border-blue-500">Método GET:</span>
                            Deve ser uma URL de uma imagem no formato PNG
                        </div>
                        <div class="my-4">
                            <span class="text-xs border p-1 text-green-500 border border-green-500">Método POST:</span>
                            Deve ser um arquivo de imagem no formato PNG <br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600"><code>size</code></td>
                    <td class="p-1 border border-slate-600">integer</td>
                    <td class="p-1 border border-slate-600"><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600">Tamanho do QRCode. Padrão: 300px</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600"><code>color</code></td>
                    <td class="p-1 border border-slate-600">string</td>
                    <td class="p-1 border border-slate-600"><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600">Cor o QRCode no formato hexdecimal. Padrão: <span
                            class="bg-black text-white">#000000</span></td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600"><code>bgcolor</code></td>
                    <td class="p-1 border border-slate-600">integer</td>
                    <td class="p-1 border border-slate-600"><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600">Fundo do QRCode no formato hexdecimal. Padrão: #ffffff</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-1xl mt-4">Erros</h3>
        <div>
            O sistema retornará um JSON se houver erros ex: <br>
            <div class="p-2 bg-black text-gray-400 rounded">
                <code>{ <br>
                    &nbsp; <span class="text-blue-600">"success": </span>false, <br>
                    &nbsp; <span class="text-blue-600">"message": </span>"Opss.. houve um erro", <br>
                    &nbsp; <span class="text-blue-600">"error": </span>"Informe um cont\u00e9udo para o QRCode, use o
                    par\u00e2metro 'content'" <br>
                    }</code>
            </div>
        </div>
    </div>

    <script defer>
        buildURL('#create-url', 'span.query')

        document.querySelectorAll('#create-url input').forEach(el => {
            el.addEventListener('input', () => buildURL('#create-url', 'span.query'))
        })

        function buildURL(form, output) {

            let formdata = new FormData(document.querySelector(form));

            let arr = Array.from(formdata.keys());

            arr.map((k) => {
                let v = formdata.get(k);
                if (!v) {
                    formdata.delete(k)
                }
            })

            let query = new URLSearchParams(formdata).toString();
            document.querySelector(output).innerHTML = `?${query}`;
        }
    </script>
</x-app>
