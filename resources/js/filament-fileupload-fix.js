// Fix para FileUpload do Filament
document.addEventListener('DOMContentLoaded', function() {
    console.log('FileUpload Fix carregado');
    
    // Aguardar o Filament carregar
    setTimeout(function() {
        // Verificar se há elementos FileUpload com problema
        const fileUploads = document.querySelectorAll('[data-filament-file-upload]');
        console.log('FileUploads encontrados:', fileUploads.length);
        
        fileUploads.forEach(function(upload, index) {
            console.log('FileUpload', index, ':', upload);
            
            // Verificar se há imagens carregadas
            const images = upload.querySelectorAll('img');
            console.log('Imagens no upload', index, ':', images.length);
            
            images.forEach(function(img, imgIndex) {
                console.log('Imagem', imgIndex, ':', img.src);
                
                // Se a imagem não carregou, tentar recarregar
                if (img.src && !img.complete) {
                    img.onload = function() {
                        console.log('Imagem carregada:', img.src);
                    };
                    img.onerror = function() {
                        console.log('Erro ao carregar imagem:', img.src);
                    };
                }
            });
        });
    }, 2000);
});
