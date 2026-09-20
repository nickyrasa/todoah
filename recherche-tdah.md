# TDA/TDAH, organisation et exécution des tâches du quotidien — synthèse de recherche

> **Ce document n'est pas un avis médical.** Il ne pose aucun diagnostic et ne remplace pas l'avis d'un professionnel de santé (médecin, psychiatre, neuropsychologue). Il synthétise, à des fins de conception produit, des sources associatives, scientifiques et de vulgarisation sérieuse sur le TDA/TDAH afin de guider (1) les fonctionnalités de l'application TODOAH et (2) la manière dont un assistant IA doit communiquer avec un utilisateur TDAH.

---

## 1. TDA/TDAH en bref

- Le TDAH (Trouble Déficit de l'Attention avec/sans Hyperactivité) est un **trouble neurodéveloppemental**, pas un trait de caractère ni un manque de volonté.
- Il touche environ **11 % des enfants d'âge scolaire** et persiste à l'âge adulte dans **plus des trois quarts des cas** (CHADD).
- Trois présentations cliniques : **inattentive**, **hyperactive-impulsive**, et **mixte** (combinaison des deux).
- Chez l'adulte, il se traduit surtout par des difficultés de fonctionnement exécutif au quotidien (travail, tâches ménagères, échéances, relations) plutôt que par une hyperactivité motrice visible.
- Selon la théorie de référence de **Russell Barkley** (1997), le TDAH n'est pas d'abord un trouble de l'attention mais un **trouble de l'inhibition et de l'autorégulation**, qui affecte en cascade plusieurs fonctions exécutives.

---

## 2. Fonctions exécutives touchées — et ce que ça change concrètement

Les « fonctions exécutives » sont les capacités mentales qui permettent de piloter son comportement vers un but : elles fonctionnent comme le **chef d'orchestre du cerveau**. Dans le TDAH, ce chef d'orchestre est présent mais moins fiable — pas absent.

| Fonction exécutive | Ce qu'elle fait normalement | Ce qui se passe dans le TDAH | Conséquence concrète au quotidien |
|---|---|---|---|
| **Mémoire de travail** | Garder une information « active » en tête le temps de l'utiliser | Les tâches, engagements ou idées quittent l'esprit dès qu'ils ne sont plus visibles ou stimulés | On oublie une tâche non urgente en une seconde, on doit être reconnecté à l'info pour y repenser ("out of sight, out of mind") |
| **Gestion/perception du temps** ("time blindness") | Estimer combien de temps une tâche prendra, sentir le temps s'écouler | Barkley parle de **« myopie temporelle »** : le cerveau ne perçoit que le présent immédiat, le futur reste abstrait | Retards chroniques, sous-estimation systématique de la durée des tâches, travail fait au dernier moment |
| **Planification** | Découper un objectif en étapes ordonnées et réalisables | Difficulté à transformer une tâche floue en étapes concrètes | Un projet ("ranger l'appartement") reste un bloc écrasant au lieu de devenir une liste d'actions |
| **Initiation de tâche** | Passer de l'intention à l'action, démarrer sans déclencheur externe | L'initiation est un des 2-3 déficits exécutifs les plus marqués du TDAH ; elle dépendrait en partie d'un déficit dopaminergique | On sait qu'il faut faire la tâche, on en a même envie, mais on n'arrive pas à « appuyer sur start » |
| **Inhibition** | Résister à une distraction ou une impulsion pour rester sur l'objectif en cours | Capacité réduite à ignorer un stimulus nouveau ou à ne pas dévier de la tâche | Une notification, une pensée ou un imprévu suffit à faire dérailler complètement la tâche en cours |
| **Régulation émotionnelle** | Moduler l'intensité et la durée d'une réaction émotionnelle | Autorégulation de l'affect identifiée par Barkley comme une des fonctions exécutives de base touchées | Frustration ou découragement disproportionnés face à un échec perçu, difficulté à « passer à autre chose » après une contrariété |

**À retenir pour la conception produit :** ces fonctions sont interdépendantes. Un oubli n'est pas un manque d'effort (mémoire de travail), un retard n'est pas de la mauvaise volonté (time blindness), et un blocage devant une tâche n'est pas de la paresse (initiation de tâche + dopamine).

---

## 3. Difficultés d'organisation typiques — et leur lien avec le vécu de l'utilisateur

| Difficulté observée | Mécanisme sous-jacent | Lien avec le vécu décrit par l'utilisateur |
|---|---|---|
| **Oubli des tâches non récurrentes ou peu stimulantes** | Sans rappel externe ni routine, la mémoire de travail ne maintient pas l'information active ; ce n'est pas un vrai défaut de permanence de l'objet mais un défaut de maintien attentionnel : la tâche existe mais devient « non prioritaire » hors du champ de conscience | Correspond exactement à « il oublie facilement les tâches qui ne sont pas répétées régulièrement ou qui ne lui plaisent pas » |
| **Procrastination par aversion de la tâche ennuyeuse** | Le cerveau TDAH, moins stimulé par la dopamine, recherche activement les tâches excitantes/urgentes et évite celles perçues comme ennuyeuses, floues ou sans échéance immédiate (« aversion à la tâche ») | Explique pourquoi certaines tâches non plaisantes sont systématiquement repoussées |
| **Désorganisation/blocage dès qu'un imprévu s'ajoute** | La flexibilité cognitive (bascule d'une tâche à l'autre) est une fonction exécutive affaiblie ; un imprévu, même petit, peut être vécu « comme une remise à zéro de la mémoire » et casse le fil de ce qui était en cours | Correspond à « la moindre tâche imprévue qui s'ajoute à son planning le perturbe et l'empêche d'avancer » |
| **Submersion face à une liste trop longue (paralysie décisionnelle)** | Le « ADHD paralysis » / surcharge de choix déclenche un gel comportemental : trop d'options ou trop de tâches simultanées épuisent la capacité de décision (fatigue décisionnelle accrue chez les TDAH) | Explique le sentiment de blocage total quand le planning déborde |
| **Hyperfocus vs difficulté à démarrer** | L'attention TDAH répond aux propriétés de la tâche (intérêt, nouveauté, urgence) plus qu'à une décision volontaire : une tâche captivante déclenche un hyperfocus difficile à interrompre, une tâche neutre reste indéfiniment évitée | Les deux extrêmes (bloqué avant de commencer / incapable de s'arrêter) sont les deux faces du même déficit de régulation de l'attention |
| **Sensibilité au rejet et à l'échec perçu (RSD)** | La *Rejection Sensitive Dysphoria* décrit une douleur émotionnelle intense et disproportionnée face à un rejet, une critique ou un échec réel ou perçu — jusqu'à 70 % des adultes TDAH rapporteraient une sensibilité émotionnelle accrue de ce type | Une tâche non faite ou en retard peut déclencher honte/évitement, ce qui pousse à fuir la liste de tâches plutôt qu'à l'affronter — un cercle vicieux |

**Point clé à ne pas manquer pour l'app :** l'imprévu qui « casse » le planning n'est pas une question de rigidité de caractère — c'est un coût cognitif réel de bascule attentionnelle (task switching) plus élevé que la moyenne. Une app qui traite les imprévus comme une exception pénible à re-planifier manuellement aggrave le problème ; une app qui absorbe l'imprévu avec un minimum de friction protège la capacité d'exécution de l'utilisateur.

---

## 4. Ce qui aide réellement — et ses implications produit

Ces leviers reviennent de façon convergente dans la littérature (CHADD, ADDA, TDAH France) et les retours de terrain (coachs TDAH, communautés, apps spécialisées type Tiimo, Focus Bear).

| Ce qui aide (littérature / terrain) | Pourquoi ça marche | Implication produit pour TODOAH |
|---|---|---|
| **Rappels multiples et progressifs** | Compense la mémoire de travail défaillante ; un seul rappel « à l'heure H » arrive souvent trop tard ou est ignoré/oublié aussitôt | Rappels échelonnés (ex. J-1, 1h avant, 10 min avant), avec intensité croissante ; ne pas se limiter à une notification unique |
| **Découpage en micro-tâches** | Contourne le déficit de planification et l'aversion à la tâche : une micro-étape est moins intimidante et démarre plus facilement (moins besoin d'« initiation ») | Décomposition automatique ou assistée d'un projet en sous-tâches actionnables de quelques minutes chacune |
| **Time-boxing / minuteurs visuels (type Pomodoro)** | Rend le temps concret et visible, ce qui compense la « cécité temporelle » ; crée une interruption externe que le cerveau ne génère pas seul | Timer visuel intégré aux tâches (barre de progression, cercle qui se vide), sessions courtes (10-25 min) avec pauses |
| **Supports visuels plutôt que texte dense** | Le TDAH traite mieux l'information concrète/visuelle que l'abstrait ; les codes couleur et pictogrammes réduisent la charge cognitive de lecture | Interface avec icônes, couleurs par catégorie/urgence, vues type calendrier visuel plutôt que listes texte longues |
| **Feedback immédiat et fréquent** | Le système de récompense dopaminergique répond mal aux gratifications différées ; un feedback rapide renforce la motivation à continuer | Micro-célébrations à chaque tâche cochée, progression visible en temps réel, pas seulement un bilan en fin de journée |
| **Faible friction de saisie / capture rapide** | Une tâche non capturée immédiatement est perdue (mémoire de travail) ; plus la saisie est lente, moins elle a de chances d'être faite | Ajout de tâche en 1-2 gestes, saisie vocale/rapide, capture accessible depuis n'importe quel écran |
| **Accountability sociale (body doubling, co-working)** | La présence (même silencieuse) d'autrui crée un sentiment de responsabilité et un effet d'imitation qui facilitent le démarrage et le maintien de l'effort | Fonctionnalité de session de travail partagée / co-présence virtuelle, ou rappel « quelqu'un attend que tu commences » |
| **Routines et habitudes comme béquilles cognitives** | Une routine automatise la décision et l'initiation : moins besoin de planifier ou de se motiver à chaque fois, l'action devient un réflexe déclenché par le contexte | Modèle de routines réutilisables, déclencheurs contextuels (heure, lieu, tâche précédente terminée) plutôt que replanification manuelle à chaque fois |
| **Absorption des imprévus à faible coût** | Réduit le coût de bascule attentionnelle ; évite que l'imprévu ne fasse dérailler tout le planning de la journée | Re-priorisation automatique ou semi-automatique du planning quand une tâche imprévue est ajoutée, plutôt que réorganisation manuelle complète |
| **Communication sans jugement, ton bienveillant** | La sensibilité au rejet (RSD) rend les messages culpabilisants contre-productifs ; ils renforcent l'évitement plutôt que l'action | Formulations neutres/encourageantes pour les tâches en retard (jamais « en retard depuis 3 jours » avec un ton accusateur) ; l'IA doit reformuler, pas culpabiliser |

### Implications directes pour la communication de l'assistant IA

- **Messages courts, concrets, actionnables** — éviter les pavés de texte, préférer une seule action claire à la fois.
- **Ne jamais culpabiliser** une tâche en retard ou oubliée ; reformuler en options positives (« on la reprogramme à demain ? » plutôt que « tâche en retard depuis 3 jours »).
- **Proposer plutôt qu'imposer** un découpage ou un replanning, pour limiter le sentiment de perte de contrôle (qui active la RSD).
- **Rappels progressifs et reformulés** plutôt que la répétition identique d'un même message ignoré.
- **Valoriser chaque petite étape terminée**, pas seulement l'achèvement final du projet.

---

## 5. Sources

- [HyperSupers – TDAH France : Organisation et stratégies de gestion du temps](https://tdah-france.fr/Organisation-et-strategies-de-gestion-du-temps.html?lang=fr)
- [HyperSupers – TDAH France : Vers une conception neuropsychologique (théorie de Barkley)](https://www.tdah-france.fr/Vers-une-conception.html)
- [CHADD – Executive Function Issues and ADHD](https://chadd.org/attention-article/executive-function-issues-and-adhd/)
- [CHADD – Executive Function Skills](https://chadd.org/about-adhd/executive-function-skills/)
- [CHADD – Understanding ADHD / About ADHD Overview](https://chadd.org/about-adhd/overview/)
- [ADDA (Attention Deficit Disorder Association) – The ADHD Body Double](https://add.org/the-body-double/)
- [ADDA – Best ADHD Apps and Tools for Adults](https://add.org/adhd-tools-for-adults/)
- [Cleveland Clinic – Rejection Sensitive Dysphoria (RSD)](https://my.clevelandclinic.org/health/diseases/24099-rejection-sensitive-dysphoria-rsd)
- [ADDitude Magazine – Rejection Sensitive Dysphoria (RSD): ADHD and Emotional Dysregulation](https://www.additudemag.com/rejection-sensitive-dysphoria-adhd-emotional-dysregulation/)
- [ADHD and Decision Paralysis: Overwhelm in a World of Choices (PMC)](https://pmc.ncbi.nlm.nih.gov/articles/PMC12438291/)
- [Cleveland Clinic – Feeling Stuck? How To Overcome ADHD Paralysis](https://health.clevelandclinic.org/adhd-paralysis)
- [Medium (John Kruse, MD PhD) – Making Object Permanence Disappear from the ADHD Discussion](https://medium.com/fourth-wave/making-object-permanence-disappear-from-the-adhd-discussion-78c630741aab)
- [The How Skills – Object Permanence and ADHD: How to Fix the "Out of Sight, Out of Mind" Mindset](https://www.thehowskills.com/blog/object-permanence-for-adhders)
- [Neurospark Health – Task Switching in ADHD: Examples, Why It's Hard, What Helps](https://neurosparkhealth.com/executive-functioning/task-switching-and-adhd)
- [TDAH Focus – Cécité temporelle liée au TDAH](https://tdahfocus.com/gestion-temps-tdah-cecite-temporelle/)
- [TDAH Focus – Hyperfocus et procrastination TDAH](https://tdahfocus.com/tdah-hyperfocus-procrastination-outils-solutions/)
- [TDAH Focus – Procrastination et TDAH : pourquoi ça bloque](https://tdahfocus.com/procrastination-tdah/)
- [Life Skills Advocate – Managing Distractions With The Pomodoro Technique For ADHD](https://lifeskillsadvocate.com/blog/pomodoro-technique-for-adhd/)
- [Super Productivity – ADHD Task Management with Visible Time](https://super-productivity.com/use-cases/adhd-focus/)

---

*Document de synthèse à usage interne pour la conception de l'application TODOAH — dernière mise à jour : 20/09/2026.*
