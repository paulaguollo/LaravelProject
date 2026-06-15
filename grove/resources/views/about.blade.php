@extends('layouts.app')

@section('content')
<div class="py-4">

    <!-- Sobre o Grove -->
    <div class="row align-items-center mb-5">
        <div class="col-md-7">
            <h2 class="mb-3">Fazer Impacto Juntos!</h2>
            <p>O Grove é uma plataforma colaborativa onde indivíduos, comunidades e organizações podem publicar, descobrir e acompanhar iniciativas de impacto sustentável desde hortas comunitárias a projetos de energia solar, campanhas de reciclagem local e esforços de economia circular.</p>
            <p>A plataforma assenta numa ideia: nenhum impacto cresce sozinho. Quem quer agir precisa de encontrar projetos que precisam de apoio. O Grove liga os dois lados.</p>
            <p class="text-muted">Qualquer pessoa pode explorar as iniciativas. Utilizadores registados podem criar as suas próprias ou acompanhar as de outros.</p>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
            <img src="{{ asset('img/community.png') }}" alt="Comunidade" class="img-fluid rounded-4" style="max-width: 400px;">
        </div>
    </div>

    <hr style="border-color: var(--color-border);">

    <!-- Como funciona -->
    <div class="row mt-5 mb-5">
        <div class="col-12 mb-4">
            <h4>Como funciona</h4>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-search mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Descobre</h5>
                <p class="text-muted mb-0">Explora iniciativas e ncontra projetos que se alinham com os teus valores e interesses.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-people mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Participa</h5>
                <p class="text-muted mb-0">Regista-te e acompanha iniciativas. Acede ao teu dashboard para gerir o teu perfil.</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 h-100">
                <i class="bi bi-plus-circle mb-3" style="font-size: 1.8rem; color: var(--color-primary-mid);"></i>
                <h5 class="card-title">Cria</h5>
                <p class="text-muted mb-0">Tens uma ideia? Publica a tua iniciativa.</p>
            </div>
        </div>
    </div>

    <hr style="border-color: var(--color-border);">

    <!-- Criadora -->
    <div class="row align-items-center mt-5">
        <div class="col-md-2 text-center mb-3 mb-md-0">
            <img src="{{ asset('img/profile.png') }}" alt="Paula Guollo" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid var(--color-surface-warm);">
        </div>
        <div class="col-md-7">
            <h5 class="mb-1">Paula Guollo</h5>
            <p class="text-muted mb-2" style="font-size: 0.85rem;">Economia & Sustentabilidade · Desenvolvimento Web no CESAE Digital</p>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">O Grove foi desenvolvido como projeto final, combinando formação em economia e sustentabilidade com desenvolvimento web back-end em framework Laravel. Co-fundadora da <a href="https://impactflow.pt" target="_blank" style="color: var(--color-primary-mid);">Impact Flow</a>, uma plataforma SaaS para programas de formação de impacto social.</p>
        </div>
        <div class="col-md-3 text-md-end mt-3 mt-md-0">
            <div class="d-flex justify-content-center justify-content-md-end gap-3">
                <a href="https://github.com/paulaguollo" target="_blank" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-github" style="font-size: 1.3rem;"></i>
                </a>
                <a href="https://www.linkedin.com/in/paula-guollo" target="_blank" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-linkedin" style="font-size: 1.3rem;"></i>
                </a>
                <a href="mailto:paulaguollo00@gmail.com" class="text-decoration-none" style="color: var(--color-text);">
                    <i class="bi bi-envelope" style="font-size: 1.3rem;"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
