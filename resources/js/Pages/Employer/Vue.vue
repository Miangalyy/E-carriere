<template>
    <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
  </button>-->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 800px;">
        <div class="modal-header"  style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLongTitle">à-propos de l'employé(e)</h5>
          <button type="button" class="close" @click="closeModal" aria-label="Close">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <img src="Images/METFP.png" alt="" style="width: 80px; height: 80px;">
              </div>
              <div class="col-4">
                <h6 style="text-transform: uppercase;">MINISTERE DE L'ENSEIGNEMENT<br>
                TECHNIQUE <br> ET DE LA FORMATION<br>PROFESSIONELLE<br>--------------------<br>
              SERVICE DES {{ editDirection.service }}</h6>
              </div>
              <div class="col-4 ml-4" style="margin-top: -90px;">
                <img src="Images/drapeau.png" alt="" style="width: 100%; height: 100%;">
              </div>  
              <div class="col-4" style="margin-top: 100px;">
                <h6><b class="mr-2" style="text-decoration: underline;">DIRECTION : </b>{{ editDirection.direction }}</h6>
              </div>
              <div class="justify-items-center col-12 mt-4" style="">
                <div class="col-4" style="border: 1px solid #000; width: 150px; height: 170px; padding: 2px;">
                  <img :src="showPic(editDirection.photo)" alt="" style="width: 100%; height: 100%;">
                </div></div>    
              <div class="col-12 mt-4">
                <p><b class="mr-2" style="text-decoration: underline;">Nom : </b>{{ editDirection.nom }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Prenom : </b>{{ editDirection.prenom }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Numero : </b>{{ editDirection.numero_employer }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Date de naissance : </b>{{ editDirection.date_naissance }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Adresse : </b>{{ editDirection.adresse }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">E-mail : </b>{{ editDirection.email }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Téléphone : </b>{{ editDirection.telephone }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Date d'embauche : </b>{{ editDirection.date_embauche }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Fonction : </b>{{ editDirection.fonction }}</p>
              </div>
              <div class="col-4">
                
              </div>
              <div class="col-6">
                <h6 style="text-transform: uppercase; text-decoration: underline;">Le grade de  l'employé(e)</h6>
              </div>
              <div class="col-4"></div>
              <div class="col-12 mt-2">
                <p><b class="mr-2" style="text-decoration: underline;">Grade : </b>{{ editDirection.grade }}</p>
                <p><b class="mr-2" style="text-decoration: underline;">Corps : </b>{{ editDirection.corps }}</p>
              </div>
              <div class="col-4">
                
              </div>
              <div class="col-6">
                <h6 style="text-transform: uppercase; text-decoration: underline;">Les expériences de  l'employé(e)</h6>
              </div>
              <div class="col-4"></div>
              <div class="col-12 mt-2">
                <p v-for="expert in editDirection.experiences"><b class="mr-2">-> </b>A été  {{ expert.experience.fonction }} du  {{ expert.nom_entreprise }} en  -------- {{ expert.date_debut }}  jusqu'á -------   {{ expert.date_fin }} </p>
              </div>
              <div class="col-4">
                
              </div>
              <div class="col-6 mt-2">
                <h6 style="text-transform: uppercase; text-decoration: underline;">Les formations suivies par l'employé(e)</h6>
              </div>
              <div class="col-4"></div>
              <div class="col-12 mt-2">
                <p v-for="forme in editDirection.formations"><b class="mr-2">-> </b>A suivi une formation pour  {{ forme.formation.nom_formation }} avec {{ forme.formation.organisme_formation }} en  -------- {{ forme.date_debut }}  jusqu'á -------   {{ forme.date_fin }} </p>
              </div>
              <div class="col-4"></div>
              <div class="col-8 mt-2">
                <h6 style="text-transform: uppercase; text-decoration: underline;">Les evaluations effectué par l'employé(e)</h6>
              </div>
              <div class="col-4"></div>
              <div class="col-12 mt-2">
                <p v-for="evalue in editDirection.evaluations"><b class="mr-2">-> </b>A évalué en -----{{ evalue.date }}----- sur le {{ evalue.evaluation.titre }} avec une appréciation de {{ evalue.commentaire }} </p>
              </div>
              <form id="sendMail">
                <div class="form-group">
                  <input type="hidden" class="form-control" v-model="editDirection.email">
                  <input type="hidden" class="form-control" v-model="editDirection.nom">
                </div>
                <div style="border-top: 1px solid rgba(0, 0, 0, 0.1); width: 700px;"></div>
                <div class="col-12 mt-2">
                  <label for="message">Votre message :</label>
                  <textarea name="message" class="form-control" v-model="editDirection.message"  :class="{'is-invalid': editDirection.messageError != '' }"></textarea>
                  <span v-if="editDirection.messageError != '' " class="invalid-feedback error">{{ editDirection.messageError }}</span>
                </div>
                <button form="sendMail" type="button" class="btn btn-primary mt-3 ml-2" @click="soumettre">Envoyer</button>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="deleteConfirmation(editDirection.numero_employer)" type="button" class="btn btn-danger">Supprimer</button>
          <Link :href="route('employer.edit', {numeroEmployer: editDirection.numero_employer})" class="btn btn-warning" @click="closeModal" style="color: white;">Modifier</Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, watch, onMounted } from "vue"
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError, useSwalConfirm } from '../../Composables/alert';

const emit = defineEmits(["modalClosed"])
let editModal = ""
onMounted(() => {
  editModal =  $("#exampleModalLong")
})
 const props = defineProps({
    directionId: {
        type: Number,
        required: true
    },
    show: {
        type: Boolean,
        default: false
    }
 })
 const editDirection = reactive({
    id: "",
    message: "",
    numero_employer: "",
    messageError: "",
    numero_employer: "",
    nom: "",
    prenom: "",
    email: "",
    telephone: "",
    adresse: "",
    date_naissance: "",
    grade: "",
    corps: "",
    date_embauche: "",
    fonction: "",
    service: "",
    photo: "",
    sexe: "",
    direction: "",
    experiences: "",
    formations: "",
    evaluations: "",
    experience_fonc: "",
    ErrorNumero_direction: "",
    ErrorDescription: "",
    ErrorResponsable: "",
    ErrorTitre: "",

 })
 const openModal = ()=>{
  editModal.modal("show")
  getDirectionById()
 }

 const closeModal = ()=>{
  editModal.modal("hide")
  emit("modalClosed")
  editDirection.message = "",
  editDirection.messageError = ""
  //formateError()
 }
 const showPic = (Employer)=>{
    if(Employer){
      return 'storage/'+Employer
    }
    return editDirection.sexe == "M" ? "images/man.jpg" : "images/woman.jpg"
  }
 const getDirectionById = ()=>{
    axios.get(route("employer.momba", { numero: props.directionId }))
    .then((response)=>{
        editDirection.id = response.data.employer.id
        editDirection.nom = response.data.employer.nom
        editDirection.numero_employer = response.data.employer.numero_employer
        editDirection.prenom = response.data.employer.prenom
        editDirection.direction = response.data.employer.service.direction.titre
        editDirection.service = response.data.employer.service.titre
        editDirection.photo = response.data.employer.photo
        editDirection.sexe = response.data.employer.sexe
        editDirection.email = response.data.employer.email
        editDirection.telephone = response.data.employer.telephone
        editDirection.adresse = response.data.employer.adresse
        editDirection.fonction = response.data.employer.fonction.titre
        editDirection.date_naissance = response.data.employer.date_naissance
        editDirection.date_embauche = response.data.employer.date_embauche
        editDirection.grade = response.data.employer.grade.titre
        editDirection.corps = response.data.employer.corps.titre
        editDirection.experiences = response.data.employer.rilier_experience
        editDirection.formations = response.data.employer.relierformation
        editDirection.evaluations = response.data.employer.relier_evaluation
        editDirection.experience_fonc = response.data.employer.rilier_experience.experience.fonction

     //   editDirection.responsable = response.data.direction.responsable
     //   editDirection.titre = response.data.direction.titre
     //   editDirection.description = response.data.direction.description
    }).catch((error)=>{
        console.log(error)
    })
 }

 const soumettre = ()=>{
  Inertia.post(route("mail"),
  {
    email: editDirection.email,
    nom: editDirection.nom,
    message: editDirection.message
  },
  {
      onSuccess: (response)=>{
          useSwalSuccess("Message envoyer avec success")
          closeModal()
      },
      onError: (error)=>{
        if(error.message != null){
          editDirection.messageError = error.message
        }
        
          useSwalError("Une erreur s'est produite :)")
      }
      
  }
  )
 }

 const deleteService = (id)=>{
        Inertia.delete(route("employer.delete", {numeroEmployer: id}), {
          onSuccess: (response)=>{
              useSwalSuccess("Service supprimé avec success .")
              closeModal()
          },
          onError: (error)=>{
             
              useSwalError(error.message ?? "Une erreur s'est produite :)")
          }
          });
       }
       const deleteConfirmation = (Service)=>{
          const message = `Vous etes sur le point de supprimer l'employé numero : "${Service}", voulez vous continuez ?`
          useSwalConfirm(message, ()=>{
             deleteService(Service)
             closeModal()
          })
       }

 watch(
  () => props.show,
  (newVal, oldVal) =>{
    if(newVal){
      openModal()
    }else{
      closeModal()
    }
  }
 )
 </script>