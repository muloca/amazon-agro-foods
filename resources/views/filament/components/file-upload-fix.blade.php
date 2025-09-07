@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('FileUpload Fix iniciado');
    
    // Aguardar o Filament carregar completamente
    setTimeout(function() {
        // Procurar por elementos FileUpload com problema
        const fileUploads = document.querySelectorAll('[data-filament-file-upload]');
        console.log('FileUploads encontrados:', fileUploads.length);
        
        fileUploads.forEach(function(upload, index) {
            console.log('Processando FileUpload', index);
            
            // Verificar se há imagens carregadas
            const images = upload.querySelectorAll('img');
            console.log('Imagens encontradas:', images.length);
            
            images.forEach(function(img, imgIndex) {
                console.log('Processando imagem', imgIndex, ':', img.src);
                
                // Se a imagem não carregou, tentar recarregar
                if (img.src && !img.complete) {
                    console.log('Tentando recarregar imagem:', img.src);
                    
                    img.onload = function() {
                        console.log('Imagem carregada com sucesso:', img.src);
                    };
                    
                    img.onerror = function() {
                        console.log('Erro ao carregar imagem:', img.src);
                        // Tentar recarregar após 1 segundo
                        setTimeout(function() {
                            img.src = img.src + '?t=' + Date.now();
                        }, 1000);
                    };
                }
            });
            
            // Verificar se há elementos com "Waiting for size"
            const waitingElements = upload.querySelectorAll('[data-waiting-for-size]');
            if (waitingElements.length > 0) {
                console.log('Elementos com "Waiting for size" encontrados:', waitingElements.length);
                
                waitingElements.forEach(function(element) {
                    console.log('Removendo "Waiting for size" de:', element);
                    element.remove();
                });
            }
        });
    }, 3000);
});
</script>
@endpush
