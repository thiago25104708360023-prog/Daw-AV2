<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumine Beauty - Agende sua Beleza</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo" id="nav-logo">
                <span class="logo-text">L U M I N E</span>
                <span class="logo-badge"></span>
                <span class="logo-text">B E A U T Y</span>
            </div>
            <nav class="nav-links">
                <a href="#" class="nav-item active" data-target="inicio">Início</a>
                <a href="#" class="nav-item" data-target="sobre">Sobre</a>
                <a href="#" class="nav-item" id="nav-contato">Contato</a>
            </nav>
            <div class="header-actions">
                <button id="btn-header-login" class="btn-login-header">Login</button>
                <div id="user-profile-icon" class="profile-icon hidden">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <div class="profile-dropdown">
                        <span id="dropdown-username">Usuário</span>
                        <hr>
                        <a href="#" id="btn-logout">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="view-container">

        <section id="view-inicio" class="view active">
            <div class="hero-banner">
                <div class="hero-content">
                    <h1>Agende sua beleza</h1>
                    <p>Reserve seus serviços de beleza com os melhores profissionais da cidade</p>
                    <button class="btn-primary" id="hero-action-btn">Confira nossos serviços</button>
                </div>
                <div class="hero-image-placeholder">
                    <div class="salon-ambient-mock"></div>
                </div>
            </div>

            <div class="services-summary-section">
                <h2>Nossos serviços</h2>
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="icon-box">✂</div>
                        <h3>Corte de Cabelo</h3>
                        <p>Cortes modernos e clássicos</p>
                    </div>
                    <div class="summary-card">
                        <div class="icon-box">🎨</div>
                        <h3>Coloração</h3>
                        <p>Coloração e luzes profissionais</p>
                    </div>
                    <div class="summary-card">
                        <div class="icon-box">💅</div>
                        <h3>Manicure</h3>
                        <p>Cuidados para suas unhas</p>
                    </div>
                    <div class="summary-card">
                        <div class="icon-box">🌿</div>
                        <h3>Tratamentos</h3>
                        <p>Tratamentos faciais e corporais</p>
                    </div>
                </div>
            </div>

            <div class="mid-banner-image">
                <div class="stylist-banner-mock"></div>
            </div>
        </section>

        <section id="view-sobre" class="view">
            <div class="sobre-container">
                <h1 class="section-title-center">Nossa <span class="accent-text">História</span></h1>
                <p class="paragraph-text">Desde 2015, em uma encantadora cidade litorânea do Brasil, a Lumine Beauty surgiu como um espaço dedicado à beleza e ao bem-estar. Fundado por Keitlin Barbosa, uma cabeleireira apaixonada, o salão nasceu com um propósito simples, porém significativo: realçar a beleza natural e oferecer um refúgio de tranquilidade.</p>
                <p class="paragraph-text">Com o passar dos anos, a equipe da Lumine Beauty cresceu, oferecendo serviços que vão de estética a maquiagem. Tornou-se um espaço querido na comunidade, conhecido pelo ambiente acolhedor e pelas ações sociais em eventos beneficentes.</p>

                <div class="about-gallery">
                    <div class="gallery-img item-1"></div>
                    <div class="gallery-img item-2"></div>
                    <div class="gallery-img item-3"></div>
                </div>

                <div class="team-block">
                    <h2>Conheça <span class="accent-text">Nosso Time</span></h2>
                    <div class="team-box-container">
                        <p>Apresentamos os profissionais talentosos que fazem da Lumine Beauty um espaço único e especial. Cada integrante da nossa equipe é apaixonado pelo que faz e comprometido em oferecer o melhor em beleza, bem-estar e cuidado.</p>
                        <ul class="team-list">
                            <li><strong>Keitlin Barbosa</strong> — Fundadora e hairstylist. Especialista em realçar a beleza natural, com anos de experiência e paixão pela transformação de vidas através da beleza.</li>
                            <li><strong>Cintia Pereira</strong> — Maquiadora profissional. Reconhecida pela criatividade e pela capacidade de transformar cada maquiagem em uma verdadeira obra de arte.</li>
                            <li><strong>Ângela Fonseca</strong> — Designer de unhas. Cuidadosa e detalhista, transforma unhas em expressões únicas de estilo e elegância.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="view-login" class="view">
            <div class="login-card">
                <h2>Login</h2>
                <div id="login-error-msg" class="error-msg hidden"></div>
                <form id="form-login" onsubmit="return false;">
                    <div class="form-group">
                        <label for="login-email">e-mail</label>
                        <input type="email" id="login-email" placeholder="Digite o e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">senha</label>
                        <input type="password" id="login-password" placeholder="Digite a senha" required>
                    </div>
                    <div class="login-actions">
                        <button type="submit" id="btn-submit-login" class="btn-orange-filled">Login</button>
                        <button type="button" id="btn-login-back" class="btn-orange-outline">Voltar</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="view-servicos" class="view">
            <div class="servicos-header">
                <h1>Serviços</h1>
            </div>
            <div id="services-categories-display" class="services-list-grid">
                <p class="loading-text">Carregando menu de serviços...</p>
            </div>
            <div class="services-action-footer">
                <button class="btn-orange-filled wide-btn" id="btn-go-to-cart-view">Agendar Agora</button>
            </div>
        </section>

        <section id="view-carrinho" class="view">
            <div class="workspace-carrinho-layout">
                <div class="carrinho-categories-selector">
                    <h2>🔶 Serviços:</h2>
                    <div class="category-panel-buttons">
                        <button class="cat-panel-btn" data-cat-id="1">Cortes de Cabelo <span class="plus-icon">⊕</span></button>
                        <button class="cat-panel-btn" data-cat-id="2">Manicure <span class="plus-icon">⊕</span></button>
                        <button class="cat-panel-btn" data-cat-id="3">Coloração <span class="plus-icon">⊕</span></button>
                        <button class="cat-panel-btn" data-cat-id="4">Tratamentos <span class="plus-icon">⊕</span></button>
                    </div>
                </div>

                <div class="checkout-cart-panel">
                    <h3>Carrinho</h3>
                    <div class="cart-divider"></div>
                    <div id="cart-items-list" class="cart-items-scroll">
                        <p class="empty-cart-notice">Seu carrinho já está vazio</p>
                    </div>
                    <div class="cart-totals">
                        <div class="total-row">
                            <span>Total:</span>
                            <span id="cart-total-value">R$ 0,00</span>
                        </div>
                        <div class="cart-action-buttons">
                            <button id="btn-proceed-payment" class="btn-orange-filled" disabled>Prosseguir com o Pagamento</button>
                            <button id="btn-trigger-clear-cart" class="btn-trash-delete">🗑️</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="view-pagamento" class="view">
            <div class="payment-selection-container">
                <h1>Escolha a Forma de Pagamento:</h1>
                
                <div class="payment-cards-grid">
                    <div class="pay-option-card pix-card" id="pay-btn-pix">
                        <div class="pix-logo-mock">pix</div>
                        <span>Pix</span>
                    </div>
                    <div class="pay-option-card card-mock credit" id="pay-btn-credit">
                        <div class="chip-card"></div>
                        <div class="card-type-label">CREDIT CARD</div>
                        <span>Crédito</span>
                    </div>
                    <div class="pay-option-card card-mock debit" id="pay-btn-debit">
                        <div class="chip-card"></div>
                        <div class="card-type-label">DEBIT CARD</div>
                        <span>Débito</span>
                    </div>
                </div>

                <div id="payment-contextual-area" class="payment-detail-box hidden"></div>
            </div>
        </section>

    </main>

    <div id="modal-services" class="modal-overlay">
        <div class="modal-box">
            <h4 id="modal-services-title">Selecionar Serviço</h4>
            <div id="modal-services-list" class="modal-list-content"></div>
            <button class="btn-modal-close" onclick="closeModal('modal-services')">Voltar</button>
        </div>
    </div>

    <div id="modal-calendar" class="modal-overlay">
        <div class="modal-box compact">
            <h4>Calendário</h4>
            <div class="calendar-header">Dom Seg Ter Qua Qui Sex Sáb</div>
            <div class="calendar-grid-days">
                <span class="day disabled">29</span><span class="day disabled">30</span>
                <span class="day select-day" data-day="01">1</span><span class="day select-day" data-day="02">2</span>
                <span class="day select-day" data-day="03">3</span><span class="day select-day" data-day="04">4</span>
                <span class="day select-day" data-day="05">5</span><span class="day select-day" data-day="06">6</span>
                <span class="day select-day" data-day="07">7</span><span class="day select-day highlight-figma" data-day="08">8</span>
                <span class="day select-day" data-day="09">9</span><span class="day select-day" data-day="10">10</span>
                <span class="day select-day" data-day="11">11</span><span class="day select-day" data-day="12">12</span>
                <span class="day select-day" data-day="13">13</span><span class="day select-day" data-day="14">14</span>
                <span class="day select-day" data-day="15">15</span><span class="day select-day" data-day="16">16</span>
                <span class="day select-day" data-day="17">17</span><span class="day select-day" data-day="18">18</span>
                <span class="day select-day" data-day="19">19</span><span class="day select-day" data-day="20">20</span>
                <span class="day select-day" data-day="21">21</span><span class="day select-day" data-day="22">22</span>
                <span class="day select-day" data-day="23">23</span><span class="day select-day" data-day="24">24</span>
                <span class="day select-day" data-day="25">25</span><span class="day select-day" data-day="26">26</span>
                <span class="day select-day" data-day="27">27</span><span class="day select-day" data-day="28">28</span>
                <span class="day select-day" data-day="29">29</span><span class="day select-day" data-day="30">30</span>
                <span class="day select-day" data-day="31">31</span><span class="day disabled">1</span>
            </div>
            <button class="btn-modal-close" onclick="closeModal('modal-calendar')">Cancelar</button>
        </div>
    </div>

    <div id="modal-hours" class="modal-overlay">
        <div class="modal-box compact">
            <h4>Selecione O Horário</h4>
            <div class="hours-grid">
                <button class="hour-slot-btn" data-time="10:00">10:00 🌐</button>
                <button class="hour-slot-btn" data-time="12:00">12:00 🌐</button>
                <button class="hour-slot-btn" data-time="14:00">14:00 🌐</button>
                <button class="hour-slot-btn" data-time="16:00">16:00 🌐</button>
                <button class="hour-slot-btn" data-time="18:00">18:00 🌐</button>
                <button class="hour-slot-btn" data-time="20:00">20:00 🌐</button>
            </div>
            <button class="btn-modal-close" onclick="closeModal('modal-hours')">Cancelar</button>
        </div>
    </div>

    <div id="modal-clear-confirm" class="modal-overlay">
        <div class="modal-box dialog">
            <h4>Deseja esvaziar o carrinho?</h4>
            <div class="dialog-actions">
                <button id="btn-confirm-clear-yes" class="btn-dialog-yes">Sim</button>
                <button id="btn-confirm-clear-no" class="btn-dialog-no">Não</button>
            </div>
        </div>
    </div>

    <footer class="main-footer" id="footer-contato-section">
        <div class="footer-top-row">
            <div class="contact-item"><span>📸</span> luminebeauty_ofc</div>
            <div class="contact-item"><span>✉️</span> luminebeautyofc@gmail.com</div>
            <div class="contact-item"><span>📞</span> +55 21 99999-9999</div>
        </div>
        <div class="footer-bottom-row">
            <div class="footer-logo">
                <span class="logo-text">L U M I N E</span>
                <span class="logo-badge"></span>
                <span class="logo-text">B E A U T Y</span>
            </div>
            <div class="footer-rights">Todos os direitos reservados</div>
            <div class="footer-motto">Onde O <span class="highlight-orange">Cuidado</span> Se Transforma Em <span class="highlight-orange">Beleza</span>.</div>
            <div class="footer-graphic-logo"><div class="hair-silhouette"></div></div>
        </div>
    </footer>

    <script src="assets/js/app.js"></script>
</body>
</html>
