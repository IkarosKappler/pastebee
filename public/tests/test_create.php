<!DOCTYPE html>
<html>
  <head>
    <title>pastebee | CREATE test</title>
    <meta charset="UTF-8">
    <meta name="description" content="Another pastebin app">
    <meta name="keywords" content="pastebee, pastebin">
    <meta name="author" content="Ikaros Kappler">
    <meta name="date" content="2018-07-12">
  </head>

  <body>
      <form action="/create.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Name" value="Testname"><br>
Content: <textarea cols="75" rows="30" name="content" placeholder="Your test content here.">PROC main()
     # print 'ISBN:'
     MV [8],73                # I
     MV [8],83                # S
     MV [8],66                # B
     MV [8],78                # N
     MV [8],58                # :

     CALL @@readln            # read String from stdin

     PUSH EAX                 # push string onto stack
     CALL @@check_isbn        # call function
     POP EDX                  # clean up stack

     MDEALLOC EDX             # free memory

/PROC

PROC check_isbn (Stringref)
                RETR EAX,1    # retrieve (not POP) address into EAX
                CMP [EAX],10  # the ISBN-10 must have 10 characters!
                JNE @failed
                MV EBX,1      # weight ranges from 1 to 10
                ADD EAX,4     # point onto the first character
                MV ECX,0      # init akku

         loop:  CMP EBX,10
                JE @ende      # if 10 is reached (len), EDX must equal checksum
                MV EDX,[EAX]  # fetch next characater
                CMP EDX,88    # 88 = X => 10 [10 is not a digit :)]
                JNE @not_X_0
                MV EDX,10     # write 10 to EDX
                JMP @check    # and jump directly to calculation

       not_X_0: SUB EDX,48    # convert EDX value (ASCII) into number! [ 0 ~= 48 ]
                CMP EDX,0
                JLT @failed
                CMP EDX,10
                JGT @failed
      check:    MUL EDX,EBX   # multiply digit with weight
                ADD ECX,EDX   # ECX += digit * weight
                MOD ECX,11    # apply MOD 11

                INC EBX       # next weight (+1)
                ADD EAX,4     # address next character from string

                JMP @loop

         end:   MV EDX,[EAX]  # fetch last character (should be given checksum)
                CMP EDX,88    # if X (~10)
                JNE @nott_X_1   # convert directly into number (substract 48)
                MV EDX,10     # otherwise: replace by 10
                JMP @check_sum  # and check both sums

     not_X_1:   SUB EDX,48    # ... convert into a number. [ 0 ~= 48 ]
     check_sum: CMP ECX,EDX   # The computed checksum must match the passed one
                JE @correct
                              # print expected number
                MV [8],69     # "EXPECTED:" = 69 88 80 69 67 84 69 68 58
                MV [8],88
                MV [8],80
                MV [8],69
                MV [8],67
                MV [8],84
                MV [8],69
                MV [8],68
                MV [8],58

                CMP ECX,10    # If ECX = 10, then print 'X
                JNE @not_10
                MV [8],88     # prints 'X'
                JMP @linebreak

     not_10:    ADD ECX,48    # Convert the numeric value in ECX into character
                MV [8],ECX
     linebreak: MV [8],10     # line break 0xA

                JMP @failed
      correct:  RETURN 1      # RETURN stores the result into EAX and restores ...
       failed:  RETURN 0      # ... the old instruction pointer from the stack.
/PROC</textarea>
      <button type="submit">Test</button>
      </form>
  </body>
</html>
