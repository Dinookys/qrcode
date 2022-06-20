<form id="create-url" action="{{ route('api-qrcode-create') }}" class="border-2 border-blue-500 rounded bg-blue-100 p-4 mt-4" target="_new" >
    <div class="mt-4 font-bold text-blue-500">Método GET</div>
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
            <x-input type="color" name="color" class="p-0 w-8 h-8" value="#000000" ></x-input>
        </div>
        <div>    
            <label>
                <span class="font-semibold">Cor de fundo</span><br>
            </label>
            <x-input type="color" name="bgcolor" class="p-0 w-8 h-8" value="#ffffff" ></x-input>
        </div>
    </div>        
    <div class="mt-4">
        <button type="submit" class="py-1 px-2 border border-black bg-black text-white rounded hover:bg-white hover:text-black ease-in duration-100">Gerar QR Code</button>
    </div>
</form>