<?php

namespace Application\Helpers\Messages;

class Message
{

    const MAX_MESSAGES = 9;

    public static $gsmSymbolsMapping = [
        "\u{0040}" => 0x00,    //	COMMERCIAL AT
        "\u{0000}" => 0x00,    //	NULL (see note above)
        "\u{00A3}" => 0x01,    //	POUND SIGN
        "\u{0024}" => 0x02,    //	DOLLAR SIGN
        "\u{00A5}" => 0x03,    //	YEN SIGN
        "\u{00E8}" => 0x04,    //	LATIN SMALL LETTER E WITH GRAVE
        "\u{00E9}" => 0x05,    //	LATIN SMALL LETTER E WITH ACUTE
        "\u{00F9}" => 0x06,    //	LATIN SMALL LETTER U WITH GRAVE
        "\u{00EC}" => 0x07,    //	LATIN SMALL LETTER I WITH GRAVE
        "\u{00F2}" => 0x08,    //	LATIN SMALL LETTER O WITH GRAVE
        "\u{00E7}" => 0x09,    //	LATIN SMALL LETTER C WITH CEDILLA
        "\u{00C7}" => 0x09,    //	LATIN CAPITAL LETTER C WITH CEDILLA (see note above)
        "\u{000A}" => 0x0A,    //	LINE FEED
        "\u{00D8}" => 0x0B,    //	LATIN CAPITAL LETTER O WITH STROKE
        "\u{00F8}" => 0x0C,    //	LATIN SMALL LETTER O WITH STROKE
        "\u{000D}" => 0x0D,    //	CARRIAGE RETURN
        "\u{00C5}" => 0x0E,    //	LATIN CAPITAL LETTER A WITH RING ABOVE
        "\u{00E5}" => 0x0F,    //	LATIN SMALL LETTER A WITH RING ABOVE
        "\u{0394}" => 0x10,    //	GREEK CAPITAL LETTER DELTA
        "\u{005F}" => 0x11,    //	LOW LINE
        "\u{03A6}" => 0x12,    //	GREEK CAPITAL LETTER PHI
        "\u{0393}" => 0x13,    //	GREEK CAPITAL LETTER GAMMA
        "\u{039B}" => 0x14,    //	GREEK CAPITAL LETTER LAMDA
        "\u{03A9}" => 0x15,    //	GREEK CAPITAL LETTER OMEGA
        "\u{03A0}" => 0x16,    //	GREEK CAPITAL LETTER PI
        "\u{03A8}" => 0x17,    //	GREEK CAPITAL LETTER PSI
        "\u{03A3}" => 0x18,    //	GREEK CAPITAL LETTER SIGMA
        "\u{0398}" => 0x19,    //	GREEK CAPITAL LETTER THETA
        "\u{039E}" => 0x1A,    //	GREEK CAPITAL LETTER XI
        "\u{00A0}" => 0x1B,    //	ESCAPE TO EXTENSION TABLE (or displayed as NBSP, see note above)
        "\u{000C}" => 0x1B0A,    //	FORM FEED
        "\u{005E}" => 0x1B14,    //	CIRCUMFLEX ACCENT
        "\u{007B}" => 0x1B28,    //	LEFT CURLY BRACKET
        "\u{007D}" => 0x1B29,    //	RIGHT CURLY BRACKET
        "\u{005C}" => 0x1B2F,    //	REVERSE SOLIDUS
        "\u{005B}" => 0x1B3C,    //	LEFT SQUARE BRACKET
        "\u{007E}" => 0x1B3D,    //	TILDE
        "\u{005D}" => 0x1B3E,    //	RIGHT SQUARE BRACKET
        "\u{007C}" => 0x1B40,    //	VERTICAL LINE
        "\u{20AC}" => 0x1B65,    //	EURO SIGN
        "\u{00C6}" => 0x1C,    //	LATIN CAPITAL LETTER AE
        "\u{00E6}" => 0x1D,    //	LATIN SMALL LETTER AE
        "\u{00DF}" => 0x1E,    //	LATIN SMALL LETTER SHARP S (German)
        "\u{00C9}" => 0x1F,    //	LATIN CAPITAL LETTER E WITH ACUTE
        "\u{0020}" => 0x20,    //	SPACE
        "\u{0021}" => 0x21,    //	EXCLAMATION MARK
        "\u{0022}" => 0x22,    //	QUOTATION MARK
        "\u{0023}" => 0x23,    //	NUMBER SIGN
        "\u{00A4}" => 0x24,    //	CURRENCY SIGN
        "\u{0025}" => 0x25,    //	PERCENT SIGN
        "\u{0026}" => 0x26,    //	AMPERSAND
        "\u{0027}" => 0x27,    //	APOSTROPHE
        "\u{0028}" => 0x28,    //	LEFT PARENTHESIS
        "\u{0029}" => 0x29,    //	RIGHT PARENTHESIS
        "\u{002A}" => 0x2A,    //	ASTERISK
        "\u{002B}" => 0x2B,    //	PLUS SIGN
        "\u{002C}" => 0x2C,    //	COMMA
        "\u{002D}" => 0x2D,    //	HYPHEN-MINUS
        "\u{002E}" => 0x2E,    //	FULL STOP
        "\u{002F}" => 0x2F,    //	SOLIDUS
        "\u{0030}" => 0x30,    //	DIGIT ZERO
        "\u{0031}" => 0x31,    //	DIGIT ONE
        "\u{0032}" => 0x32,    //	DIGIT TWO
        "\u{0033}" => 0x33,    //	DIGIT THREE
        "\u{0034}" => 0x34,    //	DIGIT FOUR
        "\u{0035}" => 0x35,    //	DIGIT FIVE
        "\u{0036}" => 0x36,    //	DIGIT SIX
        "\u{0037}" => 0x37,    //	DIGIT SEVEN
        "\u{0038}" => 0x38,    //	DIGIT EIGHT
        "\u{0039}" => 0x39,    //	DIGIT NINE
        "\u{003A}" => 0x3A,    //	COLON
        "\u{003B}" => 0x3B,    //	SEMICOLON
        "\u{003C}" => 0x3C,    //	LESS-THAN SIGN
        "\u{003D}" => 0x3D,    //	EQUALS SIGN
        "\u{003E}" => 0x3E,    //	GREATER-THAN SIGN
        "\u{003F}" => 0x3F,    //	QUESTION MARK
        "\u{00A1}" => 0x40,    //	INVERTED EXCLAMATION MARK
        "\u{0041}" => 0x41,    //	LATIN CAPITAL LETTER A
        "\u{0391}" => 0x41,    //	GREEK CAPITAL LETTER ALPHA
        "\u{0042}" => 0x42,    //	LATIN CAPITAL LETTER B
        "\u{0392}" => 0x42,    //	GREEK CAPITAL LETTER BETA
        "\u{0043}" => 0x43,    //	LATIN CAPITAL LETTER C
        "\u{0044}" => 0x44,    //	LATIN CAPITAL LETTER D
        "\u{0045}" => 0x45,    //	LATIN CAPITAL LETTER E
        "\u{0395}" => 0x45,    //	GREEK CAPITAL LETTER EPSILON
        "\u{0046}" => 0x46,    //	LATIN CAPITAL LETTER F
        "\u{0047}" => 0x47,    //	LATIN CAPITAL LETTER G
        "\u{0048}" => 0x48,    //	LATIN CAPITAL LETTER H
        "\u{0397}" => 0x48,    //	GREEK CAPITAL LETTER ETA
        "\u{0049}" => 0x49,    //	LATIN CAPITAL LETTER I
        "\u{0399}" => 0x49,    //	GREEK CAPITAL LETTER IOTA
        "\u{004A}" => 0x4A,    //	LATIN CAPITAL LETTER J
        "\u{004B}" => 0x4B,    //	LATIN CAPITAL LETTER K
        "\u{039A}" => 0x4B,    //	GREEK CAPITAL LETTER KAPPA
        "\u{004C}" => 0x4C,    //	LATIN CAPITAL LETTER L
        "\u{004D}" => 0x4D,    //	LATIN CAPITAL LETTER M
        "\u{039C}" => 0x4D,    //	GREEK CAPITAL LETTER MU
        "\u{004E}" => 0x4E,    //	LATIN CAPITAL LETTER N
        "\u{039D}" => 0x4E,    //	GREEK CAPITAL LETTER NU
        "\u{004F}" => 0x4F,    //	LATIN CAPITAL LETTER O
        "\u{039F}" => 0x4F,    //	GREEK CAPITAL LETTER OMICRON
        "\u{0050}" => 0x50,    //	LATIN CAPITAL LETTER P
        "\u{03A1}" => 0x50,    //	GREEK CAPITAL LETTER RHO
        "\u{0051}" => 0x51,    //	LATIN CAPITAL LETTER Q
        "\u{0052}" => 0x52,    //	LATIN CAPITAL LETTER R
        "\u{0053}" => 0x53,    //	LATIN CAPITAL LETTER S
        "\u{0054}" => 0x54,    //	LATIN CAPITAL LETTER T
        "\u{03A4}" => 0x54,    //	GREEK CAPITAL LETTER TAU
        "\u{0055}" => 0x55,    //	LATIN CAPITAL LETTER U
        "\u{0056}" => 0x56,    //	LATIN CAPITAL LETTER V
        "\u{0057}" => 0x57,    //	LATIN CAPITAL LETTER W
        "\u{0058}" => 0x58,    //	LATIN CAPITAL LETTER X
        "\u{03A7}" => 0x58,    //	GREEK CAPITAL LETTER CHI
        "\u{0059}" => 0x59,    //	LATIN CAPITAL LETTER Y
        "\u{03A5}" => 0x59,    //	GREEK CAPITAL LETTER UPSILON
        "\u{005A}" => 0x5A,    //	LATIN CAPITAL LETTER Z
        "\u{0396}" => 0x5A,    //	GREEK CAPITAL LETTER ZETA
        "\u{00C4}" => 0x5B,    //	LATIN CAPITAL LETTER A WITH DIAERESIS
        "\u{00D6}" => 0x5C,    //	LATIN CAPITAL LETTER O WITH DIAERESIS
        "\u{00D1}" => 0x5D,    //	LATIN CAPITAL LETTER N WITH TILDE
        "\u{00DC}" => 0x5E,    //	LATIN CAPITAL LETTER U WITH DIAERESIS
        "\u{00A7}" => 0x5F,    //	SECTION SIGN
        "\u{00BF}" => 0x60,    //	INVERTED QUESTION MARK
        "\u{0061}" => 0x61,    //	LATIN SMALL LETTER A
        "\u{0062}" => 0x62,    //	LATIN SMALL LETTER B
        "\u{0063}" => 0x63,    //	LATIN SMALL LETTER C
        "\u{0064}" => 0x64,    //	LATIN SMALL LETTER D
        "\u{0065}" => 0x65,    //	LATIN SMALL LETTER E
        "\u{0066}" => 0x66,    //	LATIN SMALL LETTER F
        "\u{0067}" => 0x67,    //	LATIN SMALL LETTER G
        "\u{0068}" => 0x68,    //	LATIN SMALL LETTER H
        "\u{0069}" => 0x69,    //	LATIN SMALL LETTER I
        "\u{006A}" => 0x6A,    //	LATIN SMALL LETTER J
        "\u{006B}" => 0x6B,    //	LATIN SMALL LETTER K
        "\u{006C}" => 0x6C,    //	LATIN SMALL LETTER L
        "\u{006D}" => 0x6D,    //	LATIN SMALL LETTER M
        "\u{006E}" => 0x6E,    //	LATIN SMALL LETTER N
        "\u{006F}" => 0x6F,    //	LATIN SMALL LETTER O
        "\u{0070}" => 0x70,    //	LATIN SMALL LETTER P
        "\u{0071}" => 0x71,    //	LATIN SMALL LETTER Q
        "\u{0072}" => 0x72,    //	LATIN SMALL LETTER R
        "\u{0073}" => 0x73,    //	LATIN SMALL LETTER S
        "\u{0074}" => 0x74,    //	LATIN SMALL LETTER T
        "\u{0075}" => 0x75,    //	LATIN SMALL LETTER U
        "\u{0076}" => 0x76,    //	LATIN SMALL LETTER V
        "\u{0077}" => 0x77,    //	LATIN SMALL LETTER W
        "\u{0078}" => 0x78,    //	LATIN SMALL LETTER X
        "\u{0079}" => 0x79,    //	LATIN SMALL LETTER Y
        "\u{007A}" => 0x7A,    //	LATIN SMALL LETTER Z
        "\u{00E4}" => 0x7B,    //	LATIN SMALL LETTER A WITH DIAERESIS
        "\u{00F6}" => 0x7C,    //	LATIN SMALL LETTER O WITH DIAERESIS
        "\u{00F1}" => 0x7D,    //	LATIN SMALL LETTER N WITH TILDE
        "\u{00FC}" => 0x7E,    //	LATIN SMALL LETTER U WITH DIAERESIS
        "\u{00E0}" => 0x7F,    //	LATIN SMALL LETTER A WITH GRAVE
    ];

    private $message;
    private $chunkedMessage;

    public function isUTF(): bool
    {
        return (bool)array_diff($this->message, array_keys(self::$gsmSymbolsMapping));
    }

    public function __construct(string $message)
    {
        $this->message = $this->mbStringToArray($message);
        $this->chunkedMessage = $this->isUTF() ? new UTF8MessageChunk($this->message) : new GsmMessageChunk($this->message);
    }

    private function mbStringToArray($string)
    {
        $strlen = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, "UTF-8");
            $string = mb_substr($string, 1, $strlen, "UTF-8");
            $strlen = mb_strlen($string);
        }
        return $array;
    }

    public function getChunkedMessage(): array
    {
        return $this->chunkedMessage->chuckMessage();
    }

    public function getMessagesCount(): int
    {
        return \count($this->chunkedMessage->chuckMessage());
    }
}