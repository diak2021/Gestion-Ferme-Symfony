<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523153225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, annee VARCHAR(50) DEFAULT NULL, code VARCHAR(50) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_en_cours TINYINT(1) DEFAULT NULL, INDEX IDX_DE92C5CFB03A8386 (created_by_id), INDEX IDX_DE92C5CF896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, date_expiration DATETIME DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, text_appercu VARCHAR(70) DEFAULT NULL, text_introductif LONGTEXT DEFAULT NULL, is_principal TINYINT(1) DEFAULT NULL, INDEX IDX_23A0E66B03A8386 (created_by_id), INDEX IDX_23A0E66896DBBDE (updated_by_id), INDEX IDX_23A0E668EB6E912 (site_web_id), INDEX IDX_23A0E66543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, categorie VARCHAR(255) DEFAULT NULL, abrege VARCHAR(50) DEFAULT NULL, code VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, prix_unitaire_par_defaut INT DEFAULT NULL, INDEX IDX_497DD634B03A8386 (created_by_id), INDEX IDX_497DD634896DBBDE (updated_by_id), INDEX IDX_497DD6348EB6E912 (site_web_id), INDEX IDX_497DD634543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, annee_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, date DATE DEFAULT NULL, montant INT DEFAULT NULL, motif LONGTEXT DEFAULT NULL, INDEX IDX_34059757543EC5F0 (annee_id), INDEX IDX_34059757BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, emetteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, email_repondu_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, rendez_vous_repondu_id INT DEFAULT NULL, objet VARCHAR(255) DEFAULT NULL, corps LONGTEXT DEFAULT NULL, email_sender VARCHAR(100) DEFAULT NULL, email_receiver VARCHAR(100) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, is_lu TINYINT(1) DEFAULT NULL, is_mail_entrant TINYINT(1) DEFAULT NULL, is_mail_sortant TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_E7927C7479E92E8C (emetteur_id), INDEX IDX_E7927C74A4F84F6E (destinataire_id), INDEX IDX_E7927C74E1725550 (email_repondu_id), INDEX IDX_E7927C74B03A8386 (created_by_id), INDEX IDX_E7927C74896DBBDE (updated_by_id), INDEX IDX_E7927C748EB6E912 (site_web_id), INDEX IDX_E7927C74543EC5F0 (annee_id), INDEX IDX_E7927C746BBA1847 (rendez_vous_repondu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, temoin_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, temoignage LONGTEXT DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, nom_complet VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, INDEX IDX_D22944581655312C (temoin_id), INDEX IDX_D2294458B03A8386 (created_by_id), INDEX IDX_D2294458896DBBDE (updated_by_id), INDEX IDX_D22944588EB6E912 (site_web_id), INDEX IDX_D2294458543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_gallerie (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_ECA31469B03A8386 (created_by_id), INDEX IDX_ECA31469896DBBDE (updated_by_id), INDEX IDX_ECA314698EB6E912 (site_web_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_7E8585C8B03A8386 (created_by_id), INDEX IDX_7E8585C8896DBBDE (updated_by_id), INDEX IDX_7E8585C88EB6E912 (site_web_id), INDEX IDX_7E8585C8543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametres (id INT AUTO_INCREMENT NOT NULL, site_web_id INT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, libelle_structure VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, linkdin VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, is_section_service_enabled TINYINT(1) DEFAULT NULL, is_section_emergency_enabled TINYINT(1) DEFAULT NULL, is_section_about_enabled TINYINT(1) DEFAULT NULL, is_section_chiffre_enabled TINYINT(1) DEFAULT NULL, is_section_col6_6_enabled TINYINT(1) DEFAULT NULL, is_sectioncol4_produit_enabled TINYINT(1) DEFAULT NULL, is_form_rdvenabled TINYINT(1) DEFAULT NULL, is_section_actualite_enabled TINYINT(1) DEFAULT NULL, is_section_testimonial_enabled TINYINT(1) DEFAULT NULL, is_section_team_enabled TINYINT(1) DEFAULT NULL, is_section_slide_outils_enabled TINYINT(1) DEFAULT NULL, is_section_pricing_enabled TINYINT(1) DEFAULT NULL, is_section_faqenabled TINYINT(1) DEFAULT NULL, is_section_maps_enabled TINYINT(1) DEFAULT NULL, is_section_quick_email_enabled TINYINT(1) DEFAULT NULL, is_facebook_enable TINYINT(1) DEFAULT NULL, is_twitter_enabled TINYINT(1) DEFAULT NULL, is_linkdin_enabled TINYINT(1) DEFAULT NULL, is_youtube_enabled TINYINT(1) DEFAULT NULL, couleur_principale VARCHAR(50) DEFAULT NULL, plage_ouverture_des_locaux VARCHAR(255) DEFAULT NULL, favicon VARCHAR(255) DEFAULT NULL, is_section_news_letter_enabled TINYINT(1) DEFAULT NULL, slogan VARCHAR(255) DEFAULT NULL, is_plage_ouverture_enabled TINYINT(1) DEFAULT NULL, is_phone_number_enabled TINYINT(1) DEFAULT NULL, is_section_disponibilite_enabled TINYINT(1) DEFAULT NULL, nombre_articles_publier INT DEFAULT NULL, email_to_admin_after_new_rdv TINYINT(1) DEFAULT NULL, email_to_client_after_new_rdv TINYINT(1) DEFAULT NULL, sms_to_client_after_new_rdv TINYINT(1) DEFAULT NULL, sms_to_admin_after_new_rdv TINYINT(1) DEFAULT NULL, email_to_client_after_new_mailing TINYINT(1) DEFAULT NULL, email_to_admin_after_new_mailing TINYINT(1) DEFAULT NULL, email_to_admin_after_new_add_newsletter TINYINT(1) DEFAULT NULL, email_to_client_after_new_add_newsletter TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_1A79799D8EB6E912 (site_web_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, annee_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, date DATE DEFAULT NULL, quantite INT DEFAULT NULL, prix_unitaire INT DEFAULT NULL, observation LONGTEXT DEFAULT NULL, INDEX IDX_D3EDB1E0543EC5F0 (annee_id), INDEX IDX_D3EDB1E0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_B6F7494EB03A8386 (created_by_id), INDEX IDX_B6F7494E896DBBDE (updated_by_id), INDEX IDX_B6F7494E8EB6E912 (site_web_id), INDEX IDX_B6F7494E543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, consultant_id INT DEFAULT NULL, service_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, date_rendez_vous DATETIME DEFAULT NULL, heure_rendez_vous TIME DEFAULT NULL, is_confirmer TINYINT(1) DEFAULT NULL, is_annuler TINYINT(1) DEFAULT NULL, is_reamenager TINYINT(1) DEFAULT NULL, has_taken_place TINYINT(1) DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, is_lu TINYINT(1) DEFAULT NULL, is_repondu TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, detail LONGTEXT DEFAULT NULL, INDEX IDX_65E8AA0A44F779A2 (consultant_id), INDEX IDX_65E8AA0AED5CA9E6 (service_id), INDEX IDX_65E8AA0AB03A8386 (created_by_id), INDEX IDX_65E8AA0A896DBBDE (updated_by_id), INDEX IDX_65E8AA0A8EB6E912 (site_web_id), INDEX IDX_65E8AA0A543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5FB6DEC71E27F6BF (question_id), INDEX IDX_5FB6DEC7B03A8386 (created_by_id), INDEX IDX_5FB6DEC7896DBBDE (updated_by_id), INDEX IDX_5FB6DEC78EB6E912 (site_web_id), INDEX IDX_5FB6DEC7543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, code VARCHAR(100) DEFAULT NULL, abrege VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, icon VARCHAR(100) DEFAULT NULL, is_title_enabled TINYINT(1) DEFAULT NULL, is_description_enabled TINYINT(1) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_E19D9AD253C59D72 (responsable_id), INDEX IDX_E19D9AD2B03A8386 (created_by_id), INDEX IDX_E19D9AD2896DBBDE (updated_by_id), INDEX IDX_E19D9AD28EB6E912 (site_web_id), INDEX IDX_E19D9AD2543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_web (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, structure VARCHAR(255) DEFAULT NULL, code VARCHAR(50) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_E1540971B03A8386 (created_by_id), INDEX IDX_E1540971896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slide (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, is_description_enabled TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_bouton_voir_plus_enabled TINYINT(1) DEFAULT NULL, is_texte_detail_enabled TINYINT(1) DEFAULT NULL, is_title_enable TINYINT(1) DEFAULT NULL, INDEX IDX_72EFEE62B03A8386 (created_by_id), INDEX IDX_72EFEE62896DBBDE (updated_by_id), INDEX IDX_72EFEE628EB6E912 (site_web_id), INDEX IDX_72EFEE62543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_member (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, linkdin VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, INDEX IDX_6FFBDA1B03A8386 (created_by_id), INDEX IDX_6FFBDA1896DBBDE (updated_by_id), INDEX IDX_6FFBDA18EB6E912 (site_web_id), INDEX IDX_6FFBDA1543EC5F0 (annee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, annee_id INT DEFAULT NULL, site_web_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) DEFAULT NULL, prenom VARCHAR(255) NOT NULL, sexe VARCHAR(10) NOT NULL, date_naissance DATETIME NOT NULL, type VARCHAR(100) NOT NULL, pseudo VARCHAR(255) DEFAULT NULL, is_actif TINYINT(1) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, date_derniere_connexion DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649B03A8386 (created_by_id), INDEX IDX_8D93D649896DBBDE (updated_by_id), INDEX IDX_8D93D649543EC5F0 (annee_id), INDEX IDX_8D93D6498EB6E912 (site_web_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annee ADD CONSTRAINT FK_DE92C5CFB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE annee ADD CONSTRAINT FK_DE92C5CF896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E668EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6348EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C7479E92E8C FOREIGN KEY (emetteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74E1725550 FOREIGN KEY (email_repondu_id) REFERENCES email (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C748EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C746BBA1847 FOREIGN KEY (rendez_vous_repondu_id) REFERENCES rendez_vous (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944581655312C FOREIGN KEY (temoin_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944588EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE image_gallerie ADD CONSTRAINT FK_ECA31469B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE image_gallerie ADD CONSTRAINT FK_ECA31469896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE image_gallerie ADD CONSTRAINT FK_ECA314698EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C88EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C8543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE parametres ADD CONSTRAINT FK_1A79799D8EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A44F779A2 FOREIGN KEY (consultant_id) REFERENCES team_member (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A8EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC78EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD253C59D72 FOREIGN KEY (responsable_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD28EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE site_web ADD CONSTRAINT FK_E1540971B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE site_web ADD CONSTRAINT FK_E1540971896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE628EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA1B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA1896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA18EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
        $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA1543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649543EC5F0 FOREIGN KEY (annee_id) REFERENCES annee (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498EB6E912 FOREIGN KEY (site_web_id) REFERENCES site_web (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66543EC5F0');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634543EC5F0');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757543EC5F0');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74543EC5F0');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458543EC5F0');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8543EC5F0');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0543EC5F0');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E543EC5F0');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A543EC5F0');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7543EC5F0');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2543EC5F0');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62543EC5F0');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA1543EC5F0');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649543EC5F0');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757BCF5E72D');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0BCF5E72D');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74E1725550');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C746BBA1847');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AED5CA9E6');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E668EB6E912');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6348EB6E912');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C748EB6E912');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944588EB6E912');
        $this->addSql('ALTER TABLE image_gallerie DROP FOREIGN KEY FK_ECA314698EB6E912');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C88EB6E912');
        $this->addSql('ALTER TABLE parametres DROP FOREIGN KEY FK_1A79799D8EB6E912');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E8EB6E912');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A8EB6E912');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC78EB6E912');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD28EB6E912');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE628EB6E912');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA18EB6E912');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498EB6E912');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A44F779A2');
        $this->addSql('ALTER TABLE annee DROP FOREIGN KEY FK_DE92C5CFB03A8386');
        $this->addSql('ALTER TABLE annee DROP FOREIGN KEY FK_DE92C5CF896DBBDE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66B03A8386');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66896DBBDE');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634B03A8386');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634896DBBDE');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C7479E92E8C');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74A4F84F6E');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74B03A8386');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74896DBBDE');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944581655312C');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458B03A8386');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458896DBBDE');
        $this->addSql('ALTER TABLE image_gallerie DROP FOREIGN KEY FK_ECA31469B03A8386');
        $this->addSql('ALTER TABLE image_gallerie DROP FOREIGN KEY FK_ECA31469896DBBDE');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8B03A8386');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C8896DBBDE');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EB03A8386');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E896DBBDE');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AB03A8386');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A896DBBDE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7B03A8386');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7896DBBDE');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD253C59D72');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2B03A8386');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2896DBBDE');
        $this->addSql('ALTER TABLE site_web DROP FOREIGN KEY FK_E1540971B03A8386');
        $this->addSql('ALTER TABLE site_web DROP FOREIGN KEY FK_E1540971896DBBDE');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62B03A8386');
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62896DBBDE');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA1B03A8386');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA1896DBBDE');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649896DBBDE');
        $this->addSql('DROP TABLE annee');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE image_gallerie');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE parametres');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE site_web');
        $this->addSql('DROP TABLE slide');
        $this->addSql('DROP TABLE team_member');
        $this->addSql('DROP TABLE `user`');
    }
}
