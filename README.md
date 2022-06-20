## QRCODE


~~~~html
baseurl/api/create?content=https%3A%2F%2Flaravel.com%2Fdocs%2F9.x%2Fblade&logo=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2Fthumb%2F9%2F9a%2FLaravel.svg%2F1200px-Laravel.svg.png&size=300&color=%23000000&bgcolor=%23ffffff
html

<table>
    <thead>
        <tr>
            <th>Parâmetro</th>
            <th>Tipo</th>
            <th>Obrigátorio</th>
            <th>Desc</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>name</code></td>
            <td>string</td>
            <td><span>Não</span></td>
            <td>Nome para o qrcode, o sistema irá redirecionar para a url apos gerar.</td>
        </tr>
        <tr>
            <td><code>content</code></td>
            <td>string</td>
            <td>Sim</td>
            <td>Contéudo que será visualizado ao ler o QRcode</td>
        </tr>
        <tr>
            <td><code>logo</code></td>
            <td>string</td>
            <td><span>Não</span></td>
            <td>Deve ser uma URL de uma imagem no formato PNG</td>
        </tr>
        <tr>
            <td><code>size</code></td>
            <td>integer</td>
            <td><span >Não</span></td>
            <td>Tamanho do QRCode. Padrão: 300px</td>
        </tr>
        <tr>
            <td><code>color</code></td>
            <td>string</td>
            <td><span >Não</span></td>
            <td>Cor o QRCode no formato hexdecimal. Padrão: <span>#000000</span></td>
        </tr>
        <tr>
            <td><code>bgcolor</code></td>
            <td>integer</td>
            <td><span >Não</span></td>
            <td>Fundo do QRCode no formato hexdecimal. Padrão: #ffffff</td>
        </tr>                
    </tbody>
</table>