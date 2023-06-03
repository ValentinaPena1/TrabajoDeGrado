import pygame
import sys
import math
import time
import random
import mysql.connector
import tkinter as tk

#pip install mysql-connector-python

# Establecer la conexión a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="root",
    password="1234",
    database="ludo"
)

ventana = tk.Tk()

# Inicializar las librerias para los sonidos, pantalla y demas 
pygame.init()
pygame.font.init()
pygame.mixer.init()

#variables que se van a usar mas adelante 
altura_boton = 30  # El botón de abajo, para iniciar juego
medida_cuadro = 200  # Medida de la imagen en pixeles
# La parte trasera de cada tarjeta
nombre_imagen_oculta = "oculta.png"
imagen_oculta = pygame.image.load(nombre_imagen_oculta)
segundos_mostrar_pieza = 2  # Segundos para ocultar la pieza si no es la correcta


class Cuadro:
    def __init__(self, fuente_imagen):
        self.mostrar = True
        self.descubierto = False
        """
        Una cosa es la fuente de la imagen (es decir, el nombre del archivo) y otra
        la imagen lista para ser pintada por PyGame
        La fuente la necesitamos para más tarde, comparar las tarjetas
        """
        self.fuente_imagen = fuente_imagen
        self.imagen_real = pygame.image.load(fuente_imagen)
# arreglo de imagenes 
cuadros = [
    [Cuadro("image1.jpg"), Cuadro("image1.jpg"),
     Cuadro("image2.jpg"), Cuadro("image2.jpg")],
    #[Cuadro("image3.jpg"), Cuadro("image3.jpg"),
     #Cuadro("image4.jpg"), Cuadro("image4.jpg")],
]

cuadros_Tres = [
    [Cuadro("Numero1.jpg"), Cuadro("Numero1.jpg"),
     Cuadro("Numero2.jpg"), Cuadro("Numero2.jpg")],
    [Cuadro("Numero3.jpg"), Cuadro("Numero3.jpg"),
     Cuadro("Numero4.jpg"), Cuadro("Numero4.jpg")],
    [Cuadro("Numero5.jpg"), Cuadro("Numero5.jpg"),
     Cuadro("Numero6.jpg"), Cuadro("Numero6.jpg")],
]

# Definir los colores que se usarán en el juego
color_blanco = (255, 255, 255)
color_negro = (0, 0, 0)
color_gris = (206, 206, 206)
color_azul = (30, 136, 229)
#sonidos
#sonido_fondo = pygame.mixer.Sound("assets/fondo.wav")
sonido_clic = pygame.mixer.Sound("assets/clic.wav")
sonido_exito = pygame.mixer.Sound("assets/ganador.wav")
sonido_fracaso = pygame.mixer.Sound("assets/equivocado.wav")
sonido_voltear = pygame.mixer.Sound("assets/voltear.wav")
pygame.mixer.music.load("assets/fondo.wav")
# Definir las dimensiones de la pantalla
SCREEN_WIDTH = 1024
SCREEN_HEIGHT = 700
anchura_pantalla = len(cuadros[0]) * medida_cuadro

altura_pantalla = (len(cuadros) * medida_cuadro) + altura_boton + 20
anchura_boton = anchura_pantalla


# La fuente que estará sobre el botón
tamanio_fuente = 20
fuente = pygame.font.SysFont("Arial", tamanio_fuente)
xFuente = int((anchura_boton / 2) - (tamanio_fuente / 2))
yFuente = int(altura_pantalla - altura_boton)

# El botón, que al final es un rectángulo
boton = pygame.Rect(0, altura_pantalla - altura_boton,
                    anchura_boton, altura_pantalla)

# Banderas
# Bandera para saber si se debe ocultar la tarjeta dentro de N segundos
ultimos_segundos = None
puede_jugar = True  # Bandera para saber si reaccionar a los eventos del usuario
# Saber si el juego está iniciado; así sabemos si ocultar o mostrar piezas, además del botón
juego_iniciado = False
# Banderas de las tarjetas cuando se busca una pareja. Las necesitamos como índices para el arreglo de cuadros
# x1 con y1 sirven para la primer tarjeta
x1 = None
y1 = None
# Y las siguientes para la segunda tarjeta
x2 = None
y2 = None
# Definir las imágenes para el juego Nivel
logo = pygame.image.load("logo.jpg")

# Definir la posición del logo en la pantalla
logo_x = 10
logo_y = 10

# Definir la fuente para el texto del juego
font = pygame.font.Font(None, 36)

# Definir el estado del juego
game_over = False

# variable de puntaje 

puntaje = 100
puntajen1 = 0
puntajen2 = 0
puntajen3 = 0
divisorpuntaje = 100/(len(cuadros)*2)

# pasa niveles 
n1 = True
n2 = False
n3 = False
nivel = 1
idusuario = 0
# Definir las funciones para el juego

def draw_text(text, x, y, screen):
    """Dibuja texto en la pantalla en una posición dada"""
    text_surface = font.render(text, True, color_negro)
    screen.blit(text_surface, (x, y))

# Ocultar todos los cuadros
def ocultar_todos_los_cuadros():
    for fila in cuadros:
        for cuadro in fila:
            cuadro.mostrar = False
            cuadro.descubierto = False


def aleatorizar_cuadros():
    # Elegir X e Y aleatorios, intercambiar
    cantidad_filas = len(cuadros)
    cantidad_columnas = len(cuadros[0])
    for y in range(cantidad_filas):
        for x in range(cantidad_columnas):
            x_aleatorio = random.randint(0, cantidad_columnas - 1)
            y_aleatorio = random.randint(0, cantidad_filas - 1)
            cuadro_temporal = cuadros[y][x]
            cuadros[y][x] = cuadros[y_aleatorio][x_aleatorio]
            cuadros[y_aleatorio][x_aleatorio] = cuadro_temporal
    


def comprobar_si_gana():
    global nivel, cuadros, puntaje, divisorpuntaje, altura_pantalla, yFuente, boton, anchura_boton, altura_boton, medida_cuadro, puntajen1, puntajen2, puntajen3, n1, n2, n3
    if gana():
        nivel +=1
        if nivel == 2:
            n2 = True
            cuadros = [
                [Cuadro("Numero1.jpg"), Cuadro("Numero1.jpg"),
                Cuadro("Numero2.jpg"), Cuadro("Numero2.jpg")],
                [Cuadro("Numero3.jpg"), Cuadro("Numero3.jpg"),
                Cuadro("Numero4.jpg"), Cuadro("Numero4.jpg")],
            ]
            puntajen1 = puntaje
            puntaje = 100
            divisorpuntaje = 100/(len(cuadros)*2)
            altura_pantalla = (len(cuadros) * medida_cuadro) + altura_boton + 20
            yFuente = int(altura_pantalla - altura_boton)
            boton = pygame.Rect(0, altura_pantalla - altura_boton,
                                anchura_boton, altura_pantalla)
        if nivel == 3:
            n3 = True
            cuadros = [
                [Cuadro("Numero1.jpg"), Cuadro("Numero1.jpg"),
                Cuadro("Numero2.jpg"), Cuadro("Numero2.jpg")],
                [Cuadro("Numero3.jpg"), Cuadro("Numero3.jpg"),
                Cuadro("Numero4.jpg"), Cuadro("Numero4.jpg")],
                [Cuadro("Numero5.jpg"), Cuadro("Numero5.jpg"),
                Cuadro("Numero6.jpg"), Cuadro("Numero6.jpg")],
            ]
            puntajen2 = puntaje
            puntaje = 100
            divisorpuntaje = 100/(len(cuadros)*2)
            altura_pantalla = (len(cuadros) * medida_cuadro) + altura_boton + 20
            yFuente = int(altura_pantalla - altura_boton)
            boton = pygame.Rect(0, altura_pantalla - altura_boton,
                                anchura_boton, altura_pantalla)
        if nivel == 4 and n1 == True and n2 == True and n3 == True:
            puntajen3 = puntaje
            pantalla_estadisticas()
        pygame.mixer.Sound.play(sonido_exito)
        reiniciar_juego()
        pygame.mixer.music.stop()
        pantalla_Siguiente_Nivel()


# Regresa False si al menos un cuadro NO está descubierto. True en caso de que absolutamente todos estén descubiertos
def gana():
    for fila in cuadros:
        for cuadro in fila:
            if not cuadro.descubierto:
                return False
    return True


def reiniciar_juego():
    global juego_iniciado, puntaje, divisorpuntaje
    juego_iniciado = False
    puntaje = 100
    divisorpuntaje = 100/(len(cuadros)*2)
    for fila in cuadros:
        for cuadro in fila:
            cuadro.descubierto = False
            cuadro.mostrar = True
    aleatorizar_cuadros()

def iniciar_juego():
    pygame.mixer.Sound.play(sonido_clic)
    global juego_iniciado
    
    ocultar_todos_los_cuadros()
    juego_iniciado = True

# Función para iniciar el juego
def start_game():
    global ultimos_segundos, puede_jugar, juego_iniciado, x1, y1, x2, y2, puntaje, divisorpuntaje
    pantalla_juego = pygame.display.set_mode((anchura_pantalla, altura_pantalla))
    pygame.mixer.music.play(-1)  # El -1 indica un loop infinito
    for i in range(3):
        aleatorizar_cuadros()
    # Ciclo infinito...
    while True:
        # Escuchar eventos, pues estamos en un ciclo infinito que se repite varias veces por segundo
        for event in pygame.event.get():
            # Si quitan el juego, salimos
            if event.type == pygame.QUIT:
                sys.exit()
            # Si hicieron clic y el usuario puede jugar...
            elif event.type == pygame.MOUSEBUTTONDOWN and puede_jugar:

                """
                xAbsoluto e yAbsoluto son las coordenadas de la pantalla en donde se hizo
                clic. PyGame no ofrece detección de clic en imagen, por ejemplo. Así que
                se deben hacer ciertos trucos
                """
                # Si el click fue sobre el botón y el juego no se ha iniciado, entonces iniciamos el juego
                xAbsoluto, yAbsoluto = event.pos
                if boton.collidepoint(event.pos):
                    if not juego_iniciado:
                        # Aleatorizar 3 veces
                        
                        iniciar_juego()

                else:
                    # Si no hay juego iniciado, ignoramos el clic
                    if not juego_iniciado:
                        continue
                    """
                    Ahora necesitamos a X e Y como índices del arreglo. Los índices no
                    son lo mismo que los pixeles, pero sabemos que las imágenes están en un arreglo
                    y por lo tanto podemos dividir las coordenadas entre la medida de cada cuadro, redondeando
                    hacia abajo, para obtener el índice.
                    Por ejemplo, si la medida del cuadro es 100, y el clic es en 140 entonces sabemos que le dieron
                    a la segunda imagen porque 140 / 100 es 1.4 y redondeado hacia abajo es 1 (la segunda posición del
                    arreglo) lo cual es correcto. Por poner otro ejemplo, si el clic fue en la X 50, al dividir da 0.5 y
                    resulta en el índice 0
                    """
                    x = math.floor(xAbsoluto / medida_cuadro)
                    y = math.floor(yAbsoluto / medida_cuadro)
                    # Primero lo primero. Si  ya está mostrada o descubierta, no hacemos nada
                    cuadro = cuadros[y][x]
                    if cuadro.mostrar or cuadro.descubierto:
                        # continue ignora lo de abajo y deja que el ciclo siga
                        continue
                    # Si es la primera vez que tocan la imagen (es decir, no están buscando el par de otra, sino apenas
                    # están descubriendo la primera)
                    if x1 is None and y1 is None:
                        # Entonces la actual es en la que acaban de dar clic, la mostramos
                        x1 = x
                        y1 = y
                        cuadros[y1][x1].mostrar = True
                        pygame.mixer.Sound.play(sonido_voltear)
                    else:
                        # En caso de que ya hubiera una clickeada anteriormente y estemos buscando el par, comparamos...
                        x2 = x
                        y2 = y
                        cuadros[y2][x2].mostrar = True
                        cuadro1 = cuadros[y1][x1]
                        cuadro2 = cuadros[y2][x2]
                        # Si coinciden, entonces a ambas las ponemos en descubiertas:
                        if cuadro1.fuente_imagen == cuadro2.fuente_imagen:
                            cuadros[y1][x1].descubierto = True
                            cuadros[y2][x2].descubierto = True
                            x1 = None
                            x2 = None
                            y1 = None
                            y2 = None
                            pygame.mixer.Sound.play(sonido_clic)
                        else:
                            pygame.mixer.Sound.play(sonido_fracaso)
                            puntaje -= divisorpuntaje
                            # Si no coinciden, tenemos que ocultarlas en el plazo de [segundos_mostrar_pieza] segundo(s). Así que establecemos
                            # la bandera. Como esto es un ciclo infinito y asíncrono, podemos usar el tiempo para saber
                            # cuándo fue el tiempo en el que se empezó a ocultar
                            ultimos_segundos = int(time.time())
                            # Hasta que el tiempo se cumpla, el usuario no puede jugar
                            puede_jugar = False
                            
                    comprobar_si_gana()
                    

        ahora = int(time.time())
        # Y aquí usamos la bandera del tiempo, de nuevo. Si los segundos actuales menos los segundos
        # en los que se empezó el ocultamiento son mayores a los segundos en los que se muestra la pieza, entonces
        # se ocultan las dos tarjetas y se reinician las banderas
        if ultimos_segundos is not None and ahora - ultimos_segundos >= segundos_mostrar_pieza:
            cuadros[y1][x1].mostrar = False
            cuadros[y2][x2].mostrar = False
            x1 = None
            y1 = None
            x2 = None
            y2 = None
            ultimos_segundos = None
            # En este momento el usuario ya puede hacer clic de nuevo pues las imágenes ya estarán ocultas
            puede_jugar = True
            if puntaje <= 50:
                reiniciar_juego()
        # Hacer toda la pantalla blanca
        pantalla_juego.fill(color_blanco)
        # Banderas para saber en dónde dibujar las imágenes, pues al final
        # la pantalla de PyGame son solo un montón de pixeles
        x = 0
        y = 20
        # Recorrer los cuadros
        

         # Crea el objeto de texto
        texto = fuente.render("Puntaje: " + str(puntaje) + "    Nivel: "+ str(nivel), True, color_negro)
        # Dibuja el texto en la ventana
        pantalla_juego.blit(texto, (0, 0))
        # validar si perdio y reiniciar el nivel
        
        for fila in cuadros:
            x = 0
            for cuadro in fila:
                """
                Si está descubierto o se debe mostrar, dibujamos la imagen real. Si no,
                dibujamos la imagen oculta
                """
                if cuadro.descubierto or cuadro.mostrar:
                    pantalla_juego.blit(cuadro.imagen_real, (x, y))
                else:
                    pantalla_juego.blit(imagen_oculta, (x, y))
                x += medida_cuadro
            y += medida_cuadro

        # También dibujamos el botón
        if juego_iniciado:
            # Si está iniciado, entonces botón blanco con fuente gris para que parezca deshabilitado
            pygame.draw.rect(pantalla_juego, color_blanco, boton)
            pantalla_juego.blit(fuente.render(
                "Iniciar juego", True, color_gris), (xFuente, yFuente))
        else:
            pygame.draw.rect(pantalla_juego, color_azul, boton)
            pantalla_juego.blit(fuente.render(
                "Iniciar juego", True, color_blanco), (xFuente, yFuente))

        # Actualizamos la pantalla
        pygame.display.update()

def pantalla_inicio():
    # Crear la pantalla
    screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
    # Botón para iniciar el juego
    button_rect = pygame.Rect(800, 600, 200, 50)
    button_font = pygame.font.Font(None, 30)
    button_text = button_font.render("Iniciar Juego", True, (220,144,250))
    button_text_rect = button_text.get_rect(center=button_rect.center)
    pygame.draw.rect(screen, (95,41,135), button_rect, 3)

    # Muestra Mensaje en la pantalla de inicio
    screen.fill((245,222,254))
    image = pygame.image.load("logo.jpg")
    screen.blit(image, (10, 10))
    draw_text("¡ Hola !", 600, 100, screen)
    draw_text("Encuentra todas las parejas de cartas", 450, 200, screen)
    draw_text("Haz clic en dos cartas para intentar emparejarlas", 400, 300, screen)
    draw_text("¡Buena suerte!", 550, 400, screen)
    image = pygame.image.load("niña sin fondo.png" )
    screen.blit(image, (-310, 110))
    pygame.draw.rect(screen, color_blanco, button_rect)
    screen.blit(button_text, button_text_rect)

    # Actualizar la pantalla de inicio
    pygame.display.flip()

    # Esperar a que el usuario haga clic en el botón de inicio
    waiting_for_start = True
    while waiting_for_start:
        for event in pygame.event.get():
            if event.type == pygame.MOUSEBUTTONDOWN:
                mouse_pos = pygame.mouse.get_pos()
                if button_rect.collidepoint(mouse_pos):
                    start_game()
                    waiting_for_start = False
            elif event.type == pygame.QUIT:
                waiting_for_start = False
                game_over = True
                sys.exit()
        #clock.tick(60)

def pantalla_Siguiente_Nivel():
    # Crear la pantalla
    screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
    # Botón para iniciar el juego
    button_rect = pygame.Rect(800, 600, 200, 50)
    button_font = pygame.font.Font(None, 30)
    button_text = button_font.render("Continuar", True, (220,144,250))
    button_text_rect = button_text.get_rect(center=button_rect.center)
    pygame.draw.rect(screen, (95,41,135), button_rect, 3)

    # Muestra Mensaje en la pantalla de inicio
    screen.fill((245,222,254))
    image = pygame.image.load("logo.jpg")
    screen.blit(image, (10, 10))
    draw_text("¡ Enhorabuena !", 600, 100, screen)
    draw_text("Has aprobado el nivel anterior", 450, 200, screen)
    draw_text("Ahora continuaremos con el siguiente nivel", 400, 300, screen)
    draw_text("¡Buena suerte!", 550, 400, screen)
    image = pygame.image.load("niña sin fondo.png" )
    screen.blit(image, (-310, 110))
    pygame.draw.rect(screen, color_blanco, button_rect)
    screen.blit(button_text, button_text_rect)

    # Actualizar la pantalla de inicio
    pygame.display.flip()

    # Esperar a que el usuario haga clic en el botón de inicio
    waiting_for_start = True
    while waiting_for_start:
        for event in pygame.event.get():
            if event.type == pygame.MOUSEBUTTONDOWN:
                mouse_pos = pygame.mouse.get_pos()
                if button_rect.collidepoint(mouse_pos):
                    start_game()
                    waiting_for_start = False
            elif event.type == pygame.QUIT:
                waiting_for_start = False
                game_over = True
                sys.exit()
        #clock.tick(60)

def pantalla_estadisticas():
    # Crear la pantalla
    crear_registro(puntajen1+puntajen2+puntajen3)
    screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
    # Botón para iniciar el juego
    button_rect = pygame.Rect(800, 600, 200, 50)
    button_font = pygame.font.Font(None, 30)
    button_text = button_font.render("Salir", True, (220,144,250))
    button_text_rect = button_text.get_rect(center=button_rect.center)
    pygame.draw.rect(screen, (95,41,135), button_rect, 3)

    # Muestra Mensaje en la pantalla de inicio
    screen.fill((245,222,254))
    image = pygame.image.load("logo.jpg")
    screen.blit(image, (10, 10))
    draw_text("¡ Enhorabuena !", 600, 100, screen)
    draw_text("Has superado todos los niveles", 450, 200, screen)
    draw_text("Puntaje Nivel 1: "+ str(puntajen1), 400, 300, screen)
    draw_text("Puntaje Nivel 2: "+ str(puntajen2), 400, 400, screen)
    draw_text("Puntaje Nivel 3: "+ str(puntajen3), 400, 500, screen)
    image = pygame.image.load("niña sin fondo.png" )
    screen.blit(image, (-310, 110))
    pygame.draw.rect(screen, color_blanco, button_rect)
    screen.blit(button_text, button_text_rect)

    # Actualizar la pantalla de inicio
    pygame.display.flip()

    # Esperar a que el usuario haga clic en el botón de inicio
    waiting_for_start = True
    while waiting_for_start:
        for event in pygame.event.get():
            if event.type == pygame.MOUSEBUTTONDOWN:
                mouse_pos = pygame.mouse.get_pos()
                if button_rect.collidepoint(mouse_pos):
                    sys.exit()
                    waiting_for_start = False
            elif event.type == pygame.QUIT:
                waiting_for_start = False
                game_over = True
                sys.exit()
        #clock.tick(60)
def crear_registro(puntajei):
    global idusuario
    cursor = conexion.cursor()
    sql = "INSERT INTO juegos (Puntaje, NombreJuego, NumeroPartida, IdUsuario, IdNivel) VALUES (%s, %s, %s, %s, %s)"
    valores = (puntajei,"Cartas",random.randint(1, 1000),idusuario,1)
    cursor.execute(sql, valores)
    conexion.commit()
    print("Registro creado con éxito.")
    cursor.close()

def verificar_login():
    global idusuario
    usuario = entry_usuario.get()
    contrasena = entry_contrasena.get()
    # Crear un cursor para ejecutar consultas SQL
    cursor = conexion.cursor()
    query = "SELECT IdUsuarios FROM usuarios WHERE Email = %s AND Clave = %s"
    values = (usuario, contrasena)
    cursor.execute(query, values)
    result = cursor.fetchone()

    if result:
        usuario_id = result[0]  # Obtener el ID del usuario de la consulta
        idusuario = usuario_id
        pantalla_inicio()
    else:
        resultado.config(text="Credenciales incorrectas", fg="red")

    cursor.close()

ventana.title("Pantalla de Login")

# Crear los elementos de la ventana
label_usuario = tk.Label(ventana, text="Usuario:")
label_contrasena = tk.Label(ventana, text="Contraseña:")
entry_usuario = tk.Entry(ventana)
entry_contrasena = tk.Entry(ventana, show="*")
boton_login = tk.Button(ventana, text="Iniciar sesión", command=verificar_login)
resultado = tk.Label(ventana, text="", fg="black")

# Posicionar los elementos en la ventana
label_usuario.grid(row=0, column=0, padx=10, pady=10)
label_contrasena.grid(row=1, column=0, padx=10, pady=10)
entry_usuario.grid(row=0, column=1, padx=10, pady=10)
entry_contrasena.grid(row=1, column=1, padx=10, pady=10)
boton_login.grid(row=2, column=0, columnspan=2, padx=10, pady=10)
resultado.grid(row=3, column=0, columnspan=2, padx=10, pady=10)

# Iniciar el bucle de la ventana
ventana.mainloop()
  
    
    