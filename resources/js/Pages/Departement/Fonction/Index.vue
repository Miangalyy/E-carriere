<template>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="cardee swiper-slide" :key="test.id" v-for="test in props.Direction">
                    <div class="iconBx">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="card-content">
                        <h2 class="name">{{ test.titre }}</h2>
                        <p class="description">Cette fonction possede {{ test.employer_count }} employés
                            </p>
                    </div>
                </div>                         
            </div>
        </div>
        <i class=" arrow arrow-next"><img src="images/right.png" alt="" style="width:35px; height:35px ;border-radius:100%;"></i>
        <i class="arrow arrow-prev"><img src="images/left.png" alt="" style="width:35px; height:35px ;border-radius:100%;"></i>
        <div class="swiper-pagination"></div>
        <!--<div class="swiper-button-next swiper-navBtn ml-4"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>-->
       </div>
    <div class="detail">
        <div class="recentsOrder">
            <div class="carde">
                <div class="cardHeader">
                    <h2 class="title ml-4">Liste des Fonctions</h2>
                    <div class="card-tools">
                        <Pagination
                        :links="props.Fonctions.links"
                        :prev="props.Fonctions.prev_page_url"
                        :next="props.Fonctions.next_page_url"
                        />
                    </div>
                </div>
                <div class="ext mt-4 mb-3">
                   <Link :href="route('fonction.create')" class="btn btn-primary boutton ml-4">
                    <i class="fa fa-plus"> Ajouter</i>
                </Link>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Numero_Fonction</th>
                                <th>Service</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th style="width: 30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="Fonction.id" v-for="Fonction in props.Fonctions.data">
                                <td>{{ Fonction.id }}</td>
                                <td>{{ Fonction.numero_fonction }}</td>
                                <td>{{ Fonction.service.numero_service }}</td>
                                <td>{{ Fonction.titre }}</td>
                                <td>{{ Fonction.description }}</td>
                                <td>
                                    <div class="d-flex justify-items-center">
                                        <Link :href="route('fonction.edit', {fonction: Fonction.id})" class="mr-2 status delivered"><i class="fas fa-pen"></i></Link>
                                        <button @click="deleteConfirmation(Fonction)" class="status pending"><i class="fas fa-trash"></i></button>
                                       </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
        </div>
    
        <div class="recentCustomers">
            <div class="carde">
                <div class="cardHeader">
                    <h2>Filtrer ici </h2>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            <div class="search" style="width: 250px;">
                                <label>
                                    <input @keyup="recherche" v-model="searchFonction" type="text" placeholder="Search Here">
                                    <i class="fa fa-search"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="">Numero_Service :</label>
                                    <select @change="recherche" v-model="filtreFonction" class="form-control">
                                        <option value=""></option>
                                        <option :key="Service.id" :value="Service.id" v-for="Service in props.Services">{{ Service.numero_service }}</option>
                                        
                                    </select>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="">Nombre de page :</label>
                                    <select @change="recherche" v-model="per_page" class="form-control">
                                        <option selected disabled value="par page">Par page</option>
                                        <option value="5"></option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                            </td>
    
                        </tr>
                    
                </table>
            </div>
    
        </div>
    </div>
    
</template>


<script setup>
  import { Inertia } from '@inertiajs/inertia';
  import Pagination from "../../../Shared/Pagination";
  import { ref } from "vue";
  import { useSwalConfirm, useSwalSuccess, useSwalError } from '../../../Composables/alert';
  import EditService from "./Edit.vue"
  import Card from "../../../Layouts/Partials/Card.vue"

  const props = defineProps({
    Fonctions: Object,
    Services: Array,
    Direction: Array,
    filtres: Object,
  })
  const editingElementId = ref(0)
   const showModal = ref(false)
  const searchFonction = ref(props.filtres.search ?? "")
  const filtreFonction = ref(props.filtres.filter ?? "")
  const per_page = ref(props.filtres.per_page ?? 5)

  const modalClosed = ()=>{
      editingElementId.value = 0
       showModal.value = false
   }

  const openEditModal = (id)=>{
       editingElementId.value = id
       showModal.value = true

   }
   const deleteFonction = (id)=>{
    Inertia.delete(route("fonction.delete", {fonction: id}), {
      onSuccess: (response)=>{
          useSwalSuccess("Fonction supprimé avec success .")
          closeModal()
      },
      onError: (error)=>{
         
          useSwalError(error.message ?? "Une erreur s'est produite :)")
      }
      });
   }
   const deleteConfirmation = (Fonction)=>{
      const message = `Vous etes sur le point de supprimer la fonction numero : "${Fonction.numero_fonction}", voulez vous continuez ?`
      useSwalConfirm(message, ()=>{
         deleteFonction(Fonction.id)
      })
   }

  const recherche = _.throttle(function(){
    

    Inertia.get(route("fonction", {search: searchFonction.value, filter: filtreFonction.value, per_page: per_page.value}), {}, {
      replace: true,
      preserveState: true
    })
  })
</script>
<style>
.slide-container{
    width: 100%;
    padding: 40px 0;
    background: #fff;
  }
  .iconBx{
    position: absolute;
    top: -5px;
    right: 0;
    font-size: 1.5rem;
    color: var(--black2);
  }
  .cardee{
    margin-right: 30px;
    width: 331px;
    border-radius: 25px;
    background: #f7f3f2; 
    padding: 20px;
    max-height: 150px;
    height: 150px;
  }
  .slide-content{
    margin: 0 40px;
    border-radius: 25px;
    overflow: hidden;
  }
  .overlay{
    position:absolute;
    top: 0;
    left: 0;
    background: #4070F4;
    height: 100%;
    width: 100%;
    border-radius: 25px 25px 0 25px;
  }
  .overlay::before,
  .overlay::after{
    content: '';
    border: none;
    position: absolute;
    width: 40px;
    height: 40px;
    right: 0;
    bottom: -40px;
    background: #4070F4;
  }
  .overlay::after{
    border-radius: 0 25px 0 0;
    background: #fff;
  }
  .image-content{
    row-gap: 5px;
    position: relative;
  }
  .image-content,
  .card-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
  }
  .card-image{
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
  }
  .card-image .card-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #4070F4;
  }
  .name{
    font-size: 18px;
    font-weight: 500;
    color: var(--blue);
  }
  .description{
    font-size: 14px;
    color: #707070;
    text-align: center;
  }
  .bouttons{
    border: none;
    background: #4070F4;
    color: #FFF;
    font-size: 16px;
    padding: 8px 16px;
    margin: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 6px;
  }
  .bouttons:hover{
    background: #265df2;
}
.swiper-navBtn{
    color: #6e93f7;
    transition: color 0.3s ease;
}
.swiper-navBtn:hover{
    color: #4070f4;
}
.swiper-navBtn::before,
.swiper-navBtn::after{
    font-size: 40px;
}
.swiper-button-next{
    right: 0;
}
.swiper-button-prev{
    left: 0;
}
.swiper-pagination-bullet{
    background: #6e93f7;
    opacity: 1;
}
.swiper-pagination-bullet-active{
    background: var(--blue);
}

@media screen and (max-width: 768px){
    .slide-content{
        margin: 0 10px;
    }
    .arrow{
        display: none;
    }
}
.arrow-next{
    position: absolute;
    top: 0px;
    right: 0px;
    color: #fff;
    font-size: 120px;
    cursor: pointer;
  
}
.arrow-prev{
    position: absolute;
    top: 0px;
    left: 0px;
    color: #fff;
    font-size: 120px;
    cursor: pointer;
  
}
</style>