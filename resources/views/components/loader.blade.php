<style>
    .loading {
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner-border-lg {
        width: 5rem;
        height: 5rem;
        border-width: 0.4em;
    }
</style>

<div class="loading" id="apploader" style="display: none" >
    <div class="spinner-border spinner-border-lg text-primary text-center" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

