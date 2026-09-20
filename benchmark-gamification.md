# Benchmark gamification — applications d'habitudes / productivité

> Objectif : identifier les mécaniques de gamification éprouvées sur le marché, comprendre lesquelles fonctionnent (et pourquoi), et surtout lesquelles présentent un risque pour un profil TDA/TDAH — pour orienter les choix produit de TODOAH. Document construit à partir de recherche web (sources en fin de document) + du constat de recherche interne `recherche-tdah.md`.

---

## 1. Fiches par application

### 1.1 Habitica (référence du genre — analyse approfondie)

**Concept** : transforme la to-do list / les habitudes en RPG rétro complet, avec avatar, combats, équipe et univers persistant.

| Mécanique | Détail |
|---|---|
| XP / niveaux | XP gagnée en cochant Habitudes positives, Quotidiennes (Dailies) et To-Do. Courbe d'XP croissante, pas de plafond réel (niveau max 9999). |
| Avatar personnalisable | Avatar RPG qui évolue avec le niveau : armure, classes (Guerrier, Mage, Guérisseur, Rogue), apparence cosmétique. |
| Points de vie / pénalité | Chaque tâche Quotidienne non cochée avant minuit (« Cron ») ou chaque « mauvaise habitude » cochée retire des PV (max 50 PV). À 0 PV, le personnage **meurt** : perte de niveau, d'objets, parfois d'équipement. |
| Quêtes & boss | Missions narratives en groupe (guilde/« party ») : on inflige des dégâts à un boss commun en accomplissant ses tâches ; à l'inverse, les tâches manquées par n'importe quel membre du groupe endommagent tout le groupe (pression sociale forte). |
| Récompenses variables (loot) | Œufs, potions d'éclosion, montures, objets à looter de façon aléatoire après les tâches — mécanique de loot-box classique. |
| Streaks | Comptage des séries de complétion par Quotidienne, avec bonus. |
| Social / guildes | Guildes thématiques, défis entre amis, groupes de responsabilisation (accountability parties) où l'échec individuel impacte le collectif. |
| Cosmétiques | Boutique d'équipements, montures, familiers, tenues saisonnières — monnaie premium (Gems) et monnaie in-game (Or). |
| Option d'assouplissement | Un bouton « Pause Damage » existe dans les paramètres pour désactiver la perte de PV — signe que la pénalité pose problème à une partie des utilisateurs. |

**Verdict rapide** : la mécanique la plus complète et la plus copiée du marché, mais aussi celle dont la pénalité (perte de vie, mort de personnage, dégâts infligés au groupe) est la plus citée comme source d'anxiété, y compris dans sa propre documentation communautaire dédiée à l'adaptation ADHD.

### 1.2 Finch — Self-Care Pet

- **Boucle centrale** : « Trigger → Action → Récompense variable » — notification/check-in quotidien → micro-tâche de self-care (boire de l'eau, respirer, ranger) → gain de Pierres Arc-en-ciel et d'Énergie pour l'oiseau virtuel.
- **Pas de système de vie ni de mort** : le pet ne peut pas « mourir » de négligence, seulement rester moins équipé/moins évolué.
- **Personnalisation** : habillage, décoration de la chambre, évolution visuelle du pet et widget qui change d'apparence en fonction des choix et des saisons.
- **Mécanique d'« Adventuring »** : une fois assez de tâches faites dans la journée, le pet part en exploration minutée — crée un effet d'anticipation (mécanique de rendez-vous).
- **Quêtes journalières + boutique** pour les profils orientés collection/accomplissement.
- **Social léger** : fonctionnalité d'amis pour s'encourager, sans compétition frontale ni classement agressif.

### 1.3 Forest

- **Mécanique centrale** : planter un arbre virtuel qui grandit pendant une session de concentration (timer) ; quitter l'app avant la fin **tue l'arbre**.
- **Monnaie virtuelle** : pièces gagnées proportionnellement au temps de concentration, dépensables pour débloquer +90 espèces d'arbres avec animations/sons propres.
- **Impact réel** : à partir d'un seuil de pièces cumulées, possibilité de financer la plantation d'un arbre réel (partenariat Trees for the Future) — transforme l'effort virtuel en impact concret, source de sens.
- **Achievements** : badges sur des jalons (nombre d'arbres, temps total, streaks de concentration).
- **Co-focus** : sessions de concentration partagées à plusieurs (accountability sociale douce).
- **Pénalité** : perte de l'arbre en cours (perte de la session), mais pas de système de vie globale ni de perte cumulée rétroactive.

### 1.4 Duolingo (mécaniques de gamification, hors gestion de tâches)

- **XP** gagnée par leçon, alimentant un classement **Ligues hebdomadaires** (Bronze → ... → Diamant, groupes de ~30 joueurs).
- **Streaks** très mises en avant visuellement — citées comme un puissant moteur d'engagement mais aussi comme un piège émotionnel (cf. témoignages d'utilisateurs dévastés en perdant un streak de plusieurs centaines de jours).
- **Cœurs / vies** : système de vies limitées, épuisées par les erreurs ; rechargées avec des Gems (monnaie in-app) ou en attendant — mécanique de pénalité par friction plutôt que par perte de progression.
- **Gems** : monnaie utilisée pour objets boutique, réparations de streak (« Streak Freeze »), recharge de cœurs.
- **Feedback immédiat** : retour visuel/haptique à chaque bonne réponse, renforcement continu.
- **Personnalisation légère** : mascotte (Duo), habillage limité.
- **Evolution récente (2026)** : priorisation d'un score de progression réelle plutôt que du seul XP, et personnalisation IA de la difficulté/rythme — signe d'un début de correction des effets pervers du pur système de classement.

### 1.5 Fabulous

- **Structure en « Journeys »** (parcours) thématiques multi-jours : chaque jour débloque une seule nouvelle micro-tâche, empilée progressivement (habit stacking) — jamais tout d'un coup.
- **Storytelling motivationnel** : cadrage autour d'une « lettre de ton futur toi », approche coaching plutôt que pur tracking.
- **Streak visuel non punitif** : animation de feu de camp qui grandit avec la régularité (métaphore chaleureuse plutôt que barre de vie).
- **Feedback sensoriel soigné** : sons/animations à chaque interaction, y compris pendant l'onboarding.
- **Pas de système de perte de vie ni de classement compétitif** — la gamification sert la pédagogie comportementale, pas la compétition.

### 1.6 SuperBetter

- Conçue à l'origine comme outil de résilience psychologique (post-traumatisme, dépression, anxiété), pas de productivity tracker pur, mais très pertinente pour la dimension émotionnelle du TDAH.
- **Quêtes** : défis gradués vers un « Epic Win » (objectif final) défini par l'utilisateur.
- **Power-Ups** : actions positives rapides qu'on peut activer pour remonter son énergie/humeur.
- **Bad Guys** : externalisation des obstacles internes (ex. « Procrastination », « Perfectionnisme ») nommés et personnifiés — recadrage cognitif ludique plutôt que culpabilisation.
- **Allies** : cercle de soutien social explicite, sollicitable en cas de coup dur.
- **Aucune mécanique de pénalité/perte** — tout le système est construit en ajout (gain de résilience), jamais en soustraction.

### 1.7 EpicWin

- To-do list habillée en RPG minimaliste : chaque tâche cochée déclenche une **animation de combat/loot**.
- **XP et Or** répartis sur des statistiques de personnage (force, sagesse, etc. selon la catégorie de tâche choisie).
- **Loot aléatoire** à la complétion (récompense variable).
- Pas de mécanique de vie/mort documentée : le risque est surtout la simplicité qui plafonne vite l'intérêt à long terme (pas de guildes, pas de narration continue).

### 1.8 Streaks

- App volontairement minimaliste : **le streak est l'unique mécanique de gamification**, représenté par un cercle de couleur par habitude.
- Exploite directement l'**aversion à la perte** (peur de « casser » la série) plutôt que l'appât du gain.
- **Streak Freeze** : nombre limité de « jokers » mensuels pour absorber un jour manqué sans casser la série — amorti mais toujours fondé sur la peur de la rupture.
- Aucune couche RPG, sociale ou cosmétique — clarté maximale, mais aucun filet de récupération narratif après une vraie rupture (le compteur repart à zéro et rien n'accompagne ce moment).

### 1.9 Habitify (app additionnelle pertinente)

- XP par habitude complétée, 20 niveaux nommés (« Beginner » → « Unbreakable »), badges de consistance/streak/« recovery ».
- **Momentum Score** : remplace le streak binaire par un score qui **décroît progressivement** en cas de manquement et **récupère progressivement** au lieu de retomber brutalement à zéro — réponse directe et récente au problème de la rupture de streak.
- Rapport hebdomadaire personnalisé + coach IA conversationnel pour comprendre les manquements sans jugement.
- Différenciateur clé pour TODOAH : c'est l'app la plus proche d'une résolution produit du problème « streak brisé = démotivation totale ».

---

## 2. Tableau comparatif des mécaniques

| App | XP / niveaux | Avatar perso. | Quêtes / défis | Pénalité / perte de vie | Récompense variable (loot) | Streaks | Social / guildes | Cosmétiques |
|---|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
| **Habitica** | Oui (fort) | Oui (fort) | Oui (boss, groupe) | **Oui — PV, mort du perso, dégâts au groupe** | Oui (œufs, potions) | Oui | Oui (guildes, party) | Oui (fort) |
| **Finch** | Oui (léger, énergie) | Oui (pet) | Oui (quêtes du jour) | Non | Oui (pierres, décor) | Oui (doux) | Léger (amis) | Oui |
| **Forest** | Non (pièces seulement) | Non | Non | Oui — mais limitée à la session (arbre qui meurt) | Non (achat direct) | Oui | Léger (co-focus) | Oui (espèces d'arbres) |
| **Duolingo** | Oui (fort) | Léger (mascotte) | Oui (leçons/défis) | Oui — cœurs limités, friction | Oui (coffres, gemmes) | Oui (fort, médiatisé) | Oui (ligues, classement) | Léger |
| **Fabulous** | Non (progression narrative) | Non | Oui (Journeys) | Non | Non | Oui (non punitif) | Non | Léger |
| **SuperBetter** | Léger (niveaux de résilience) | Non | Oui (quêtes perso) | Non | Non | Non | Oui (Allies) | Non |
| **EpicWin** | Oui | Léger | Non | Non documentée | Oui (loot) | Léger | Non | Léger |
| **Streaks** | Non | Non | Non | Implicite (peur de la rupture) | Non | **Oui — mécanique unique** | Non | Non |
| **Habitify** | Oui | Non | Non | Non (Momentum Score dégressif, pas de reset brutal) | Non | Oui (repensé) | Léger | Non |

---

## 3. Ce qui marche en gamification — cadres de référence (synthèse, non exhaustive)

| Levier | Principe | Illustration dans les apps étudiées |
|---|---|---|
| **Théorie de l'autodétermination (Deci & Ryan)** | Trois besoins psychologiques de base à nourrir : **autonomie** (choix réels, pas d'obligation arbitraire), **compétence** (défis calibrés + feedback de progression clair), **lien social** (appartenance, soutien) | Fabulous (autonomie du parcours), Habitica/Finch (compétence via niveaux), guildes/Allies/amis (lien social) |
| **Boucle de récompense variable** | Une récompense d'intensité imprévisible (loot aléatoire) active le circuit de la dopamine plus fortement qu'une récompense fixe et attendue | Loot Habitica/EpicWin, coffres Duolingo, pierres/décor Finch |
| **Aversion à la perte** | La peur de perdre un acquis motive plus que l'espoir d'un gain équivalent | Streaks (cercle qui casse), Habitica (PV), Duolingo (streak) — **arme à double tranchant**, cf. section 4 |
| **Progression visible et décomposée** | Rendre tangible une progression autrement abstraite (jauge, palier, XP) réduit la charge cognitive de « où j'en suis » | XP/niveaux quasi universels ; jauge d'arbre de Forest ; feu de camp de Fabulous |
| **Petits pas engageants (habit stacking / journeys)** | Démarrer par une action minuscule crée un sentiment de compétence immédiat, qui facilite l'ajout de la tâche suivante | Fabulous (Journeys), Finch (une tâche → adventure) |
| **Feedback immédiat** | Le renforcement doit arriver dans la seconde qui suit l'action, pas en fin de journée | Sons/animations Duolingo, Fabulous, Finch |
| **Sens / impact réel** | Relier l'effort virtuel à un impact perçu comme réel augmente l'engagement au-delà du jeu pur | Arbres réels plantés par Forest |

---

## 4. Risques de la gamification pour un profil TDA/TDAH

Ce tableau croise chaque risque observé sur le marché avec le constat correspondant de `recherche-tdah.md`.

| Risque observé | Où on le voit | Constat TDAH concerné | Pourquoi c'est dangereux |
|---|---|---|---|
| **Pénalité / perte de vie après une tâche manquée** | Habitica (PV, mort du perso, dégâts au groupe) | RSD (sensibilité au rejet/à l'échec, §3 recherche-tdah) | Une tâche non faite est déjà vécue comme un échec personnel disproportionné ; une pénalité visuelle et mécanique (perte de PV, mort) rejoue et amplifie ce sentiment plutôt que de le neutraliser. Les témoignages utilisateurs confirment : « ça m'a démotivé », « ça déclenche l'anxiété » — au point que Habitica a dû ajouter un bouton « Pause Damage ». |
| **Streak brisé = tout recommencer à zéro** | Streaks, Duolingo, Habitica | RSD + aversion à la tâche + oubli des tâches non stimulantes (§3) | Le TDAH génère structurellement plus de jours « ratés » (oubli, imprévu, hyperfocus ailleurs) ; un streak binaire punit une variabilité neurologique normale comme si c'était un manque de volonté, ce qui active honte et évitement plutôt que remotivation. |
| **Pression sociale de groupe qui rejaillit sur l'échec individuel** | Habitica (dégâts au groupe/party quand un membre manque une Daily) | RSD | Ajoute une couche de culpabilité vis-à-vis d'autrui à la culpabilité déjà ressentie envers soi-même — risque de retrait social ou d'évitement total de l'app. |
| **Surcharge de systèmes de progression cumulés (XP + niveaux + monnaie + classement + guilde + cosmétiques...)** | Habitica en particulier, dans une moindre mesure Duolingo | Paralysie décisionnelle / submersion face à trop d'options (§3) | Chaque système supplémentaire est un point de décision et de charge cognitive de plus ; pour un cerveau déjà sujet à la fatigue décisionnelle, une interface « riche » en mécaniques peut devenir un obstacle plutôt qu'un moteur. |
| **Classements compétitifs (leagues, leaderboard)** | Duolingo | RSD + régulation émotionnelle | La comparaison sociale directe expose à un risque d'échec public perçu ; peut décourager plutôt que stimuler chez une personne déjà sensible à l'évaluation. |
| **Notifications/rappels uniques liés à un système punitif** | Duolingo (peur de perdre le streak), Habitica (Cron quotidien) | Time blindness + mémoire de travail (§2) | Un rappel qui active la peur de la pénalité plutôt que l'envie d'agir renforce l'évitement de la notification elle-même (elle devient une source de stress à ignorer). |
| **Complexité d'entrée (courbe d'apprentissage du système de jeu)** | Habitica | Initiation de tâche (§2) | Si comprendre le système de jeu devient lui-même une tâche complexe, il ajoute une barrière d'initiation supplémentaire au lieu de la réduire. |

**Nuance importante** : Habitica reste citée par une partie de la littérature comme un système « quasi conçu pour le cerveau TDAH » (nouveauté, feedback immédiat, accountability) — le risque n'est donc pas la gamification RPG en soi, mais spécifiquement sa **composante punitive/soustractive** (perte de vie, mort, dégâts de groupe) superposée à un système par ailleurs efficace.

---

## 5. Conclusion — recommandations pour TODOAH

### Mécaniques à reprendre

| Mécanique | Inspirée de | Justification |
|---|---|---|
| XP / niveaux avec progression visible et décomposée | Habitica, Duolingo, EpicWin | Rend la progression tangible, compense l'abstraction du futur (time blindness) |
| Avatar / pet évolutif et personnalisable | Habitica, Finch | Levier d'attachement émotionnel non punitif ; la personnalisation nourrit le besoin d'autonomie (SDT) |
| Récompense variable (loot léger) à la complétion | Habitica, EpicWin, Finch, Duolingo | Boucle dopaminergique adaptée au besoin de feedback immédiat du TDAH |
| Décomposition en micro-étapes façon « Journeys » | Fabulous | Compense directement le déficit de planification et l'aversion à la tâche ennuyeuse |
| Streak **non binaire**, à dégradation/récupération progressive (type Momentum Score) | Habitify | Absorbe la variabilité TDAH sans effet « tout ou rien » ; retire l'angle mort du streak classique |
| Système de « jokers » / pause volontaire sur une mécanique exigeante | Streaks (Streak Freeze), Habitica (Pause Damage) | Donne un filet de sécurité choisi par l'utilisateur, sans le priver du système s'il le souhaite |
| Externalisation ludique des obstacles internes (type « Bad Guys ») | SuperBetter | Aide à nommer l'aversion à la tâche/la procrastination sans que l'utilisateur s'auto-inculpe |
| Accountability sociale légère et opt-in (amis, co-focus) | Forest, Finch, SuperBetter (Allies) | Reproduit le bénéfice du « body doubling » identifié en §4 de recherche-tdah, sans compétition frontale |
| Sens/impact concret relié à l'effort | Forest (arbres réels) | Renforce la motivation intrinsèque au-delà du seul jeu |

### Mécaniques à éviter ou à adapter

| Mécanique | Vue dans | Pourquoi l'éviter/l'adapter pour un profil TDAH |
|---|---|---|
| **Perte de vie / mort de personnage** | Habitica | Rejoue directement la RSD : transforme un oubli (mémoire de travail défaillante) en événement dramatique et culpabilisant. **À éviter totalement**, ou à proposer uniquement en option explicitement activée par l'utilisateur qui la souhaite (jamais par défaut). |
| **Streak binaire remis à zéro** | Streaks, Duolingo, Habitica | Punit une irrégularité neurologiquement attendue comme un échec moral. **À remplacer** par une mécanique dégressive/récupérable (cf. Habitify) qui tolère la variabilité sans effacer l'historique. |
| **Dégâts ou conséquences négatives subis par le groupe à cause d'un individu** | Habitica (party) | Ajoute une culpabilité sociale au-dessus de la culpabilité individuelle (double couche de RSD). **À éviter** ; préférer un social qui célèbre les réussites du groupe plutôt qu'il ne sanctionne les échecs individuels. |
| **Classement compétitif public (leaderboard, ligues)** | Duolingo | Expose à la comparaison sociale directe, terrain glissant pour la RSD. **À adapter** : préférer des comparaisons à soi-même (progression personnelle) plutôt qu'aux autres, ou rendre le classement strictement optionnel et privé. |
| **Empilement de trop de systèmes de progression simultanés** | Habitica | Risque de surcharge/paralysie décisionnelle. **À limiter** : une boucle de progression principale claire (XP/niveau + une couche cosmétique), pas cinq systèmes parallèles à gérer en même temps. |
| **Notifications de rappel formulées autour de la menace de perte** | Duolingo, Habitica | Transforme le rappel (utile contre la mémoire de travail défaillante) en déclencheur de stress évité activement. **À reformuler** en ton neutre/encourageant, jamais culpabilisant, conformément à la recommandation de communication de recherche-tdah.md (§4). |
| **Système de jeu trop riche à apprendre avant de pouvoir commencer** | Habitica | Ajoute une barrière d'initiation supplémentaire (déjà le point faible n°1 du TDAH, §2). **À éviter** : onboarding progressif, mécaniques révélées au fur et à mesure plutôt qu'un système complet dès le premier lancement. |

---

## 6. Sources

- [Habitica — Level (Wiki)](https://habitica.fandom.com/wiki/Level)
- [Habitica — Experience Points (Wiki)](https://habitica.fandom.com/wiki/Experience_Points)
- [Habitica — Quests (Wiki)](https://habitica.fandom.com/wiki/Quests)
- [Habitica — Health Points (Wiki)](https://habitica.fandom.com/wiki/Health_Points)
- [Habitica — Damage to Player (Wiki)](https://habitica.fandom.com/wiki/Damage_to_Player)
- [Habitica — Death Mechanics (Wiki)](https://habitica.fandom.com/wiki/Death_Mechanics)
- [Habitica — Adapting Habitica for ADHD (Wiki)](https://habitica.fandom.com/wiki/Adapting_Habitica_for_ADHD)
- [Habitica — site officiel](https://habitica.com/)
- [Deconstructor of Fun — How Wellness App Finch Uses Gamified Widgets to Drive Retention](https://www.deconstructoroffun.com/blog/x0hd2ssr80y5n7gv0w967pg7hwd7tl)
- [YourStory — App Friday: Finch's gamification of self-care](https://yourstory.com/2022/06/app-review-self-care-pet-finch-gamifies-mental-wellbeing)
- [Slate — Finch review: this self-care app promises gentle wellness](https://slate.com/technology/2026/09/finch-app-self-care-wellness-review.html)
- [Trophy.so — How Forest Leverages Gamification to Boost Retention](https://trophy.so/blog/forest-gamification-case-study)
- [Medium — How a top-rated productivity app, Forest, uses gamification to retain users](https://medium.com/design-bootcamp/how-a-top-rated-productivity-app-forest-uses-gamification-to-retain-users-9345f6867a2d)
- [Forest (application) — Wikipedia](https://en.wikipedia.org/wiki/Forest_(application))
- [StriveCloud — Duolingo gamification explained](https://www.strivecloud.io/duolingo-gamification-explained)
- [Ludaxis — The Psychology of Gamification: Duolingo case study 2026](https://www.ludaxis.io/blog/gamification-in-apps-duolingo-case-study-2026)
- [Orizon — Duolingo's Gamification Secrets: Streaks & XP](https://www.orizon.co/blog/duolingos-gamification-secrets)
- [Medium — I lost my 165-day Duolingo Streak and other unfortunate UX events](https://medium.com/@bobbywops/is-duolingo-the-easy-way-to-learn-langu-b58885cddd0d)
- [Medium — How Fabulous Turns Habits Into Rituals: A Case Study in Behavior Design](https://medium.com/@preciousebunoluwaa/how-fabulous-turns-habits-into-rituals-a-case-study-in-behavior-design-51b3ae18ffd3)
- [ChoosingTherapy — Fabulous App Review 2026](https://www.choosingtherapy.com/fabulous-app-review/)
- [Naavik — New Horizons in Habit-Building Gamification](https://naavik.co/deep-dives/deep-dives-new-horizons-in-gamification/)
- [Trophy.so — SuperBetter's Gamification Strategy: A Case Study](https://trophy.so/blog/superbetter-gamification-case-study)
- [GamificationHub — How Does SuperBetter Work?](https://www.gamificationhub.org/how-does-superbetter-work/)
- [GamificationHub — SuperBetter for Neurodivergent Users & ADHD Management](https://www.gamificationhub.org/superbetter-for-neurodivergent-users-and-adhd-management/)
- [BoardGameGeek — EPICWIN: App turns to-do list tasks into an RPG experience](https://boardgamegeek.com/thread/542373/epicwin-app-turns-to-do-list-tasks-into-an-rpg-exp)
- [GamifyList — Epic to-do list](https://gamifylist.com/app/epic-to-do-list)
- [Trophy.so — How Streaks Leverages Gamification to Boost Retention](https://trophy.so/blog/streaks-gamification-case-study)
- [AppStorys — Streaks & Milestones: Habit-Forming Gamification](https://appstorys.com/blog-Streaks-Milestones-Habit-Gamification)
- [Habify (Habitify) — Google Play](https://play.google.com/store/apps/details?id=io.habify.app&hl=en_US)
- [Habitify — Apple App Store](https://apps.apple.com/us/app/habitify-habit-tracker/id1111447047)
- [Yu-kai Chou — Self-Determination Theory at Work: Deci & Ryan](https://yukaichou.com/gamification-analysis/self-determination-theory-at-work-gagne-deci-autonomy-competence-relatedness/)
- [Yu-kai Chou — Self-Determination Theory: Deci & Ryan's 6 Mini-Theories](https://yukaichou.com/gamification-analysis/self-determination-theory-guide-to-ryan-and-decis-motivation-framework/)
- [Medium — I Tested 10 Habit Trackers in 30 Days. 8 Broke Me the Same Way.](https://medium.com/@wardtylerd/i-tested-10-habit-trackers-in-30-days-8-broke-me-the-same-way-9803ea20b228)
- [Calmevo — Best Habit Tracking App for ADHD in 2026](https://calmevo.com/best-habit-tracking-app-for-adhd/)
- [habi.app — 5 Best Habitica Alternatives in 2026](https://habi.app/insights/habitica-alternatives/)

---

*Document de synthèse à usage interne pour la conception de l'application TODOAH — rédigé le 20/09/2026.*
