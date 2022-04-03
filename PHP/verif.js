function verify(id,path){
    if (confirm("Etes vous sur?")) {
        
        path+='?id=';
        path+=id;
        console.log(path);
        location.href = path;
    }
}