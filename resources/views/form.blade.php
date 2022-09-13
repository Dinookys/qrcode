<form id="create-url" action="{{ route('api-qrcode-create') }}"
    x-bind:class="postType ? 'form-post' : 'form-get'" target="_new" 
    x-bind:method="postType ? 'POST' : 'GET'" 
    enctype="multipart/form-data"
    >
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
            <x-input placeholder="Ex: http://url.com.br, um texto" name="content" required></x-input>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-none gap-4">        
        <div>
            <label>
                <span class="font-semibold">Logotipo (opcional)</span>
            </label>            
            <label><input type="checkbox" x-model="postType" class="inline-block w-auto" />Subir um arquivo</label>
            <div class="my-2">
                <template x-if="!postType" >
                    <x-input placeholder="Ex: http://cdn.com.br/logo.png" name="logo"></x-input>
                </template>
                <template x-if="postType" >
                    <x-input type="file" name="logo" accept="image/png" ></x-input>
                </template>
            </div>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        <div>
            <label>
                <span class="font-semibold">Tamanho (pixel)</span>
            </label>
            <x-input placeholder="Ex: 300" name="size" type="number" min="100" value="300"></x-input>
        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 gap-4">
        <div>
            <label>
                <span class="font-semibold">Cor</span><br>
            </label>
            <x-input type="color" name="color" class="p-0 w-8 h-8" value="#000000"></x-input>
        </div>
        <div>
            <label>
                <span class="font-semibold">Cor de fundo</span><br>
            </label>
            <x-input type="color" name="bgcolor" class="p-0 w-8 h-8" value="#ffffff"></x-input>
        </div>
    </div>
    <div class="mt-4">
        <button type="submit"
            class="py-1 px-2 border border-black bg-black text-white rounded hover:bg-white hover:text-black ease-in duration-100">Gerar
            QR Code</button>
    </div>
</form>
