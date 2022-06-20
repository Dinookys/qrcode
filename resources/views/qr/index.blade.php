<x-app>
    <x-slot name="title">QRCode</x-slot>

    <h1 class="text-2xl font-semibold border-b-2 border-black text-right">QRCode</h1>

    <form id="create-url" action="{{ route('api-qrcode-create') }}" class="border rounded p-4 mt-4" target="_new" >
        <div class="mt-4 grid  grid-cols-2 gap-4">
            <div>    
                <label>
                    <span class="font-semibold">Nome do QR Code (opcional)</span>
                </label>
                <x-input placeholder="Ex: qr-code-prod-321" name="name"></x-input>
            </div>           
        </div>
        <div class="mt-4 grid grid-cols-none gap-4">
            <div>    
                <label>
                    <span class="font-semibold">Conteúdo do QR Code</span>
                </label>
                <x-input placeholder="Ex: http://url.com.br, um texto" name="content" required ></x-input>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-none gap-4">
            <div>    
                <label>
                    <span class="font-semibold">Logotipo (opcional)</span>
                </label>
                <x-input placeholder="Ex: http://cdn.com.br/logo.png" name="logo"></x-input>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>    
                <label>
                    <span class="font-semibold">Tamanho (pixel)</span>
                </label>
                <x-input placeholder="Ex: 300" name="size" type="number" min="100" value="300" ></x-input>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>    
                <label>
                    <span class="font-semibold">Cor</span><br>
                </label>
                <x-input type="color" name="color" class="p-0 w-12 h-8" value="#000000" ></x-input>
            </div>
            <div>    
                <label>
                    <span class="font-semibold">Cor de fundo</span><br>
                </label>
                <x-input type="color" name="bgcolor" class="p-0 w-12 h-8" value="#ffffff" ></x-input>
            </div>
        </div>        
        <div class="mt-4">
            <button type="submit" class="py-1 px-2 border border-black bg-black text-white rounded hover:bg-white hover:text-black ease-in duration-100">Gerar QR Code</button>
        </div>
    </form>

    <h3 class="text-1xl mt-4">Copie a URL abaixo ou click em Gerar QR-Code</h3>
    <div class="p-2 bg-black text-gray-400 rounded overflow-x-auto" >
        {{ route('api-qrcode-create') }}<span class="query text-green-600 word-wrap" ></span>
    </div>

    <h3 class="text-1xl mt-4">Parâmetros da URL</h3>
    <div>
        <table class="table-fixed border-collapse border-spacing-2 p-1 border border-slate-500 w-full" >
            <thead>
                <tr>
                    <th class="p-1 border border-slate-600 w-48" >Parâmetro</th>
                    <th class="p-1 border border-slate-600 w-48" >Tipo</th>
                    <th class="p-1 border border-slate-600 w-48" >Obrigátorio</th>
                    <th class="p-1 border border-slate-600" >Desc</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>name</code></td>
                    <td class="p-1 border border-slate-600" >string</td>
                    <td class="p-1 border border-slate-600" ><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600" >Nome para o qrcode, o sistema irá redirecionar para a url apos gerar.</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>content</code></td>
                    <td class="p-1 border border-slate-600" >string</td>
                    <td class="p-1 border border-slate-600" >Sim</td>
                    <td class="p-1 border border-slate-600" >Contéudo que será visualizado ao ler o QRcode</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>logo</code></td>
                    <td class="p-1 border border-slate-600" >string</td>
                    <td class="p-1 border border-slate-600" ><span class="text-gray-300">Não</span></td>
                    <td class="p-1 border border-slate-600" >Deve ser uma URL de uma imagem no formato PNG</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>size</code></td>
                    <td class="p-1 border border-slate-600" >integer</td>
                    <td class="p-1 border border-slate-600" ><span class="text-gray-300" >Não</span></td>
                    <td class="p-1 border border-slate-600" >Tamanho do QRCode. Padrão: 300px</td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>color</code></td>
                    <td class="p-1 border border-slate-600" >string</td>
                    <td class="p-1 border border-slate-600" ><span class="text-gray-300" >Não</span></td>
                    <td class="p-1 border border-slate-600" >Cor o QRCode no formato hexdecimal. Padrão: <span class="bg-black text-white">#000000</span></td>
                </tr>
                <tr>
                    <td class="p-1 border border-slate-600" ><code>bgcolor</code></td>
                    <td class="p-1 border border-slate-600" >integer</td>
                    <td class="p-1 border border-slate-600" ><span class="text-gray-300" >Não</span></td>
                    <td class="p-1 border border-slate-600" >Fundo do QRCode no formato hexdecimal. Padrão: #ffffff</td>
                </tr>                
            </tbody>
        </table>

        <h3 class="text-1xl mt-4">Erros</h3>
        <div>
            O sistema retornará um JSON se houver erros ex: <br>
            <div  class="p-2 bg-black text-gray-400 rounded"  >
                <code>{ <br>
                &nbsp; <span class="text-blue-600" >"success": </span>false, <br>
                &nbsp; <span class="text-blue-600" >"message": </span>"Opss.. houve um erro", <br>
                &nbsp; <span class="text-blue-600" >"error": </span>"Informe um cont\u00e9udo para o QRCode, use o par\u00e2metro 'content'" <br>
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
                if(!v) {
                    formdata.delete(k)
                }                                
            })

            let query = new URLSearchParams(formdata).toString();
            document.querySelector(output).innerHTML = `?${query}`;
        }
    </script>
</x-app>