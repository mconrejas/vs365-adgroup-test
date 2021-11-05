class Storage {
    set( key, obj ) {
        sessionStorage.setItem( key, JSON.stringify( obj ) );
    }

    get( key ) {
        const obj = sessionStorage.getItem( key );
        return obj ? JSON.parse( obj ) : null;
    }

    remove( key ) {
        sessionStorage.removeItem( key );
    }
}

export default new Storage();